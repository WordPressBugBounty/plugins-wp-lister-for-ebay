<?php
/**
 * WPLE_TranslationHelper class
 * 
 * Handles translation functionality for different WordPress translation plugins
 * including TranslatePress, qTranslate X, and qTranslate Classic.
 */

class WPLE_TranslationHelper {


    /**
     * Translate text using available translation plugin
     *
     * @param string $text Text to translate
     * @param int $account_id Account ID to determine target locale
     * @return string Translated text or original text if no translation plugin is active
     */
    static function translateText( $text, $account_id ) {

        if ( function_exists( 'qtranxf_use' ) ) {
            $locale = WPLE_eBayAccount::getAccountLocale( $account_id );
            return qtranxf_use( $locale, $text );
        } elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
            return qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $text );
        }

        return $text;
    }
}