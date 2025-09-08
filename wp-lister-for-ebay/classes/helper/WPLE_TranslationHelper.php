<?php
/**
 * WPLE_TranslationHelper class
 * 
 * Handles translation functionality for different WordPress translation plugins
 * including TranslatePress, qTranslate X, and qTranslate Classic.
 */

class WPLE_TranslationHelper {

    /**
     * Get account locale as full locale code for TranslatePress
     *
     * @param int $account_id Account ID
     * @return string Full locale code (e.g., 'en_US', 'de_DE')
     */
    static function getAccountLocaleFullCode( $account_id ) {
        $short_locale = WPLE_eBayAccount::getAccountLocale( $account_id );

        switch ( $short_locale ) {
            case 'de':
                $full_locale = 'de_DE';
                break;
            case 'fr':
                $full_locale = 'fr_FR';
                break;
            case 'it':
                $full_locale = 'it_IT';
                break;
            case 'es':
                $full_locale = 'es_ES';
                break;
            case 'nl':
                $full_locale = 'nl_NL';
                break;
            default:
                $full_locale = 'en_US';
                break;
        }

        return apply_filters( 'wple_account_locale_full_code', $full_locale, $account_id );
    }

    /**
     * Translate text using available translation plugin
     *
     * @param string $text Text to translate
     * @param int $account_id Account ID to determine target locale
     * @return string Translated text or original text if no translation plugin is active
     */
    static function translateText( $text, $account_id ) {
        if ( function_exists( 'trp_translate' ) ) {
            $full_locale = self::getAccountLocaleFullCode( $account_id );
            return trp_translate( $text, $full_locale, false );
        } elseif ( function_exists( 'qtranxf_use' ) ) {
            $locale = WPLE_eBayAccount::getAccountLocale( $account_id );
            return qtranxf_use( $locale, $text );
        } elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
            return qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $text );
        }
        
        return $text;
    }
}