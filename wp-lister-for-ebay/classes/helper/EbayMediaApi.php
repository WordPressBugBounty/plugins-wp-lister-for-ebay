<?php

require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/autoload.php';

class EbayMediaApi {
	protected $api_url;
	/** @var string host+base path of the Image resource - a DIFFERENT host, see __construct() */
	protected $image_api_url;
	protected $wpl_account;

	/* @var Swagger\Client\Configuration */
	protected $api_config;

	/* @var Swagger\Client\Configuration separate instance for the Image resource (other host) */
	protected $image_api_config;

	/**
	 * Holds the message of the last caught Exception/ApiException from an Image call,
	 * so EbayController::uploadToEPS() can build a Trading-shaped ErrorType from it
	 * instead of a generic hardcoded string. Only populated by the Image methods below;
	 * the pre-existing Document methods (createDocument/uploadDocument, used for GPSR)
	 * are left untouched to avoid any behaviour change for that shipping feature.
	 *
	 * @var string|null
	 */
	protected $last_error;

	/**
	 * HTTP status code and raw response body of that same last Image failure.
	 * The message string alone is not a reliable discriminator: Guzzle truncates the
	 * body it embeds in the RequestException message (120 chars by default), and the
	 * non-RequestException branch of the generated client builds the message from the
	 * status code and URI only, with the body going to ApiException::getResponseBody()
	 * instead. Both are needed to tell eBay's "insufficient permissions" (errorId 1100)
	 * apart from a transport or server-side failure, which must NOT get a reconnect hint.
	 *
	 * @var int|null
	 */
	protected $last_error_code;

	/** @var string|null */
	protected $last_error_body;

	public function __construct( $account_id ) {
		// NOT WPLE()->accounts: that array is filled once per request by
		// WPLE_eBayAccount::getAll() (wp-lister-ebay.php:148-153) and is never refreshed
		// when a token is minted mid-request, so the client ends up configured with the
		// EXPIRED token - the first call 401s and the next page load works. For the
		// operator that reads as "it works sometimes", which after a release gets
		// misread as a staged rollout on eBay's side.
		// getAccount() reads PAST that array: update() drops the object cache entry when
		// a token is written (eBayAccount.php:269), so the next read comes from the DB.
		// Measured twice on this codebase: 36d862d9e (2026-08-08, taxonomy/GPSR) and
		// again by wash on the bytes of this branch, 2026-11-03
		// (/home/shared/2026-11-03-77821-mediaapi-token-klickpfad-WASH.md).
		$account = WPLE_eBayAccount::getAccount( $account_id );

		$this->wpl_account  = $account;
		// same sandbox/production switch used by EbayMarketplaceApi and EbayTaxonomyModel
		$this->api_url      = $account->sandbox_mode
			? 'https://api.sandbox.ebay.com/commerce/media/v1_beta'
			: 'https://api.ebay.com/commerce/media/v1_beta';

		$this->api_config = Swagger\Client\Configuration::getDefaultConfiguration()
		                                                ->setAccessToken($account->oauth_token)
		                                                ->setHost( $this->api_url );

		// The Media API is served from TWO production hosts and they are NOT
		// interchangeable per resource. Measured 2026-10-28 against live account 19
		// (#77821, probe in ~dave/wple-77821-media-probe-2026-10-28/):
		//
		//   POST api.ebay.com /document                     -> 400 + API_MEDIA error body (served)
		//   POST api.ebay.com /image/create_image_from_url   -> 404, ZERO bytes
		//   POST apim.ebay.com/image/create_image_from_url   -> 201 + imageUrl on i.ebayimg.com
		//   POST apim.ebay.com/document                      -> 404 ACCESS "Resource not found"
		//
		// Both hosts are listed as "Production" in eBay's own contract
		// (developer.ebay.com/develop/api/spec/media_api.json, v1_beta.5.1, servers[]),
		// with no per-operation hint which serves what. The 404 carries an EMPTY body,
		// byte-identical to a path that does not exist, which is why this read as
		// "the Image resource is not live" until both hosts were measured side by side.
		//
		// So: documents (GPSR, shipping since Nov 2024) stay on api.ebay.com, pictures
		// go to apim.ebay.com. Separate config object, because
		// Configuration::getDefaultConfiguration() is a process-wide SINGLETON
		// (includes/ebay-rest-api/lib/Configuration.php:367) shared with
		// EbayMarketplaceApi/EbayTaxonomyModel - calling setHost() on it a second time
		// would silently move the document calls too.
		//
		// NOT MEASURED: the sandbox host for the Image resource. eBay's contract lists
		// no sandbox server at all, so sandbox keeps the old host rather than guessing
		// at 'apim.sandbox.ebay.com'. Overridable via the filter below.
		$this->image_api_url = $account->sandbox_mode
			? $this->api_url
			: 'https://apim.ebay.com/commerce/media/v1_beta';
		$this->image_api_url = apply_filters( 'wple_media_api_image_host', $this->image_api_url, $account );

		$this->image_api_config = clone $this->api_config;
		$this->image_api_config->setHost( $this->image_api_url );
	}

	/**
	 * Mint BEFORE the call, not after it, and put the result where the request
	 * actually reads it.
	 *
	 * The generated client takes bearer token and host out of the Configuration at the
	 * moment it builds the request (Api/ImageApi.php:342-343/:360, :610-611/:628), not
	 * when the Api object is constructed. Two reasons both config objects have to be
	 * written here, immediately before every call:
	 *
	 *  1. Token. The constructor froze a string copy of the token into the config. Any
	 *     mint that happens afterwards (ours or a caller's) does not travel into it.
	 *     maybeMintToken() returns FALSE when the token is still valid - which includes
	 *     the case where a caller already minted in this request - so FALSE must fall
	 *     back to $this->wpl_account->oauth_token, and that object has to come from
	 *     getAccount() for the fallback to be fresh. This is why 9d686a678 ("use the
	 *     return value") was not enough and 36d862d9e superseded it.
	 *  2. Host. $api_config IS Configuration::getDefaultConfiguration(), a process-wide
	 *     singleton (includes/ebay-rest-api/lib/Configuration.php:367) shared with
	 *     EbayMarketplaceApi/EbayTaxonomyModel/EbayMarketplaceModel. Any one of those
	 *     constructed later in the same request re-points the singleton's host, which
	 *     would otherwise send the document calls to the taxonomy host.
	 *
	 * $image_api_config is a clone, so it does NOT follow a write to the singleton -
	 * it keeps its own host (apim.ebay.com) but it also has to be handed the token
	 * separately. Setting one and not the other is how the two paths drift apart.
	 */
	protected function refreshApiConfig() {
		$minted = WPLE_eBayAccount::maybeMintToken( $this->wpl_account->id );
		if ( $minted ) {
			$this->wpl_account->oauth_token = $minted;
		}

		$this->api_config->setAccessToken( $this->wpl_account->oauth_token )
		                 ->setHost( $this->api_url );

		if ( $this->image_api_config ) {
			$this->image_api_config->setAccessToken( $this->wpl_account->oauth_token )
			                       ->setHost( $this->image_api_url );
		}
	}

	/**
	 * @return string|null message of the last caught Exception from createImageFromUrl()/createImageFromFile()
	 */
	public function getLastError() {
		return $this->last_error;
	}

	/**
	 * @return int|null HTTP status code of the last failed Image call, 0 if the request never got a response
	 */
	public function getLastErrorCode() {
		return $this->last_error_code;
	}

	/**
	 * @return string|null raw response body of the last failed Image call (eBay's JSON error envelope)
	 */
	public function getLastErrorBody() {
		return $this->last_error_body;
	}

	/**
	 * Record message, status code and body of a failed Image call in one place, so the
	 * two call sites cannot drift apart. ApiException carries the body separately; a
	 * plain Exception (or a connection failure, where getCode() is 0) carries neither.
	 *
	 * @param \Throwable $e
	 */
	protected function rememberLastError( $e ) {
		$this->last_error      = $e->getMessage();
		$this->last_error_code = (int) $e->getCode();
		$this->last_error_body = null;

		if ( $e instanceof \Swagger\Client\ApiException ) {
			$body = $e->getResponseBody();
			// in the non-RequestException branch the generated client hands the
			// PSR-7 stream itself to ApiException, not its contents
			if ( is_object( $body ) && is_callable( array( $body, '__toString' ) ) ) {
				$body = (string) $body;
			}
			$this->last_error_body = is_string( $body ) ? $body : null;
		}
	}

	/**
	 * @return false|\Swagger\Client\Model\CreateDocumentResponse
	 * @throws Exception
	 */
	public function createDocument( $type ) {
		$api = new \Swagger\Client\Api\DocumentApi( new \GuzzleHttp\Client(), $this->api_config );

		WPLE()->initEC( $this->wpl_account->id );
		$this->refreshApiConfig();

		try {
			return $api->createDocument( $type );
		} catch ( \Throwable $e ) {
			WPLE()->logger->error( $e->getMessage() );
			return false;
		}
		return $resp;
	}

	/**
	 * @param $document_id
	 * @param $document_path
	 *
	 * @return false|\Swagger\Client\Model\DocumentResponse
	 * @throws Exception
	 */
	public function uploadDocument( $document_id, $document_path ) {
		$doc = fopen($document_path, 'r');
		$contents = fread($doc, filesize($document_path));
		fclose($doc);

		$api = new \Swagger\Client\Api\DocumentApi( new \GuzzleHttp\Client(['body'=>$contents]), $this->api_config );

		WPLE()->initEC( $this->wpl_account->id );
		$this->refreshApiConfig();

		try {
			return $api->uploadDocument( $document_id, 'multipart/form-data' );
		} catch ( \Throwable $e ) {
			WPLE()->logger->error( 'Error in EbayMediaApi::uploadDocument - '. $e->getMessage() );
			return false;
		}
	}

	/**
	 * Passive EPS transfer mode: eBay copies the image from an externally reachable
	 * HTTPS URL. This is the Media API equivalent of the Trading API's
	 * UploadSiteHostedPictures call with <ExternalPictureURL> set.
	 *
	 * Note: eBay requires the source URL to be HTTPS for this call (see
	 * EbayController::uploadToEPS() for the http:// fallback to createImageFromFile()).
	 *
	 * Sent through the WordPress HTTP API, not the bundled Guzzle/Swagger client - see
	 * sendImageRequest() (#77809).
	 *
	 * @param string $image_url HTTPS source URL of the picture to copy into EPS
	 *
	 * @return false|\Swagger\Client\Model\ImageResponse
	 */
	public function createImageFromUrl( $image_url ) {
		$this->last_error = $this->last_error_code = $this->last_error_body = null;

		$body = wp_json_encode( array( 'imageUrl' => $image_url ) );

		return $this->sendImageRequest( '/image/create_image_from_url', 'application/json', $body, 'createImageFromUrl' );
	}

	/**
	 * Active EPS transfer mode: the picture bytes are uploaded directly to eBay.
	 * This is the Media API equivalent of the Trading API's UploadSiteHostedPictures
	 * call with <PictureData> set (binary attachment).
	 *
	 * Deliberately takes the raw picture bytes rather than a file path (unlike
	 * uploadDocument() above): EbayController::uploadToEPS() in active mode already
	 * loads the bytes into memory (from the local filesystem, or via wp_remote_get()
	 * as a fallback when there is no local file), so there is no local file to point
	 * to in the fallback case.
	 *
	 * @param string $picture_data raw binary image content
	 *
	 * @return false|\Swagger\Client\Model\ImageResponse
	 */
	public function createImageFromFile( $picture_data ) {
		$this->last_error = $this->last_error_code = $this->last_error_body = null;

		// The bytes must travel as a REAL multipart envelope, and the boundary must be
		// in the Content-Type header. Measured 2026-10-28 against live account 19
		// (#77821, same probe dir as in __construct()):
		//
		//   raw bytes + 'Content-Type: multipart/form-data' (no boundary)
		//       -> HTTP 500, errorId 2003 ACCESS "Internal error", parameters code=400
		//   proper envelope, part name "image" + 'boundary=...'
		//       -> HTTP 201 + imageUrl, picture fetchable from i.ebayimg.com
		//
		// The envelope below is byte-for-byte what \GuzzleHttp\Psr7\MultipartStream
		// produced for array( 'name' => 'image', 'contents' => $picture_data,
		// 'filename' => 'image' ) in 3.8.16 (Guzzle adds 'application/octet-stream' as the
		// part type because the filename has no extension), built by hand since #77809.
		$boundary = bin2hex( random_bytes( 20 ) );
		$body     = "--{$boundary}\r\n"
		          . "Content-Disposition: form-data; name=\"image\"; filename=\"image\"\r\n"
		          . 'Content-Length: ' . strlen( $picture_data ) . "\r\n"
		          . "Content-Type: application/octet-stream\r\n"
		          . "\r\n"
		          . $picture_data . "\r\n"
		          . "--{$boundary}--\r\n";

		return $this->sendImageRequest( '/image/create_image_from_file', 'multipart/form-data; boundary=' . $boundary, $body, 'createImageFromFile' );
	}

	/**
	 * POST one Image call through the WordPress HTTP API.
	 *
	 * #77809: these two calls used to go through the generated Swagger client and the
	 * bundled, UNSCOPED guzzlehttp/psr7. When another plugin ships an older psr7 and its
	 * \GuzzleHttp\Psr7\Utils is autoloaded first, our Stream::getContents() calls
	 * Utils::tryGetContents(), which that copy does not have -> uncaught \Error, and
	 * every publish/revise with EPS images died (customer screenshot, Stream.php:105 <-
	 * ImageApi.php:427). wp_remote_post() cannot collide with anyone's Guzzle.
	 *
	 * Wire shape kept identical to ImageApi::createImageFrom*Request(): host from
	 * $this->image_api_config (apim.ebay.com, see __construct()), Bearer token read
	 * AFTER initEC() + refreshApiConfig(), Accept: application/json, the config's
	 * User-Agent.
	 *
	 * @param string $resource_path e.g. '/image/create_image_from_file'
	 * @param string $content_type  request Content-Type header
	 * @param string $body          raw request body
	 * @param string $method        caller name, for the log line
	 *
	 * @return false|\Swagger\Client\Model\ImageResponse
	 */
	protected function sendImageRequest( $resource_path, $content_type, $body, $method ) {
		try {
			WPLE()->initEC( $this->wpl_account->id );
			$this->refreshApiConfig();

			$url     = $this->image_api_config->getHost() . $resource_path;
			$headers = array(
				'Accept'       => 'application/json',
				'Content-Type' => $content_type,
			);
			if ( $this->image_api_config->getAccessToken() !== null ) {
				$headers['Authorization'] = 'Bearer ' . $this->image_api_config->getAccessToken();
			}
			if ( $this->image_api_config->getUserAgent() ) {
				$headers['User-Agent'] = $this->image_api_config->getUserAgent();
			}

			$response = wp_remote_post( $url, array(
				'method'  => 'POST',
				'headers' => $headers,
				'body'    => $body,
				'timeout' => 60,
			) );

			if ( is_wp_error( $response ) ) {
				// connection failure: no status, no body - same as a Guzzle ConnectException (code 0)
				$this->last_error      = '[0] ' . $response->get_error_message();
				$this->last_error_code = 0;
				$this->last_error_body = null;
				WPLE()->logger->error( 'Error in EbayMediaApi::' . $method . ' - ' . $this->last_error );
				return false;
			}

			$status        = (int) wp_remote_retrieve_response_code( $response );
			$response_body = (string) wp_remote_retrieve_body( $response );

			if ( $status < 200 || $status > 299 ) {
				$this->last_error      = sprintf( '[%d] Error connecting to the API (%s): %s', $status, $url, substr( $response_body, 0, 500 ) );
				$this->last_error_code = $status;
				$this->last_error_body = $response_body;
				WPLE()->logger->error( 'Error in EbayMediaApi::' . $method . ' - ' . $this->last_error );
				return false;
			}

			$decoded = json_decode( $response_body );
			if ( ! is_object( $decoded ) ) {
				$this->last_error      = sprintf( '[%d] Unexpected response from the API (%s): %s', $status, $url, substr( $response_body, 0, 500 ) );
				$this->last_error_code = $status;
				$this->last_error_body = $response_body;
				WPLE()->logger->error( 'Error in EbayMediaApi::' . $method . ' - ' . $this->last_error );
				return false;
			}

			// model deserialization only - ObjectSerializer::deserialize() does not touch psr7
			return \Swagger\Client\ObjectSerializer::deserialize( $decoded, '\Swagger\Client\Model\ImageResponse', array() );

		} catch ( \Throwable $e ) {
			$this->rememberLastError( $e );
			WPLE()->logger->error( 'Error in EbayMediaApi::' . $method . ' - ' . $e->getMessage() );
			return false;
		}
	}

}
