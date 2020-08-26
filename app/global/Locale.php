<?php

class Locale
{
    static $LANG = null;
    static $LANG_DIR = BASE_PATH . '/app/locale';
    static $DOMAIN_NAME = 'wbc';
    static $ALLOW_LANG = [
        'en' => 'en_US.utf8',
        'ru' => 'ru_RU.utf8'
    ];

    public static function init()
    {
        self::$LANG = self::getLocale();
        self::setLocale(self::$LANG, self::$DOMAIN_NAME);
    }

    public static function clearCache()
    {
        $langDirList = array(
            self::$LANG_DIR,
        );

        $domainList = array(
            self::$DOMAIN_NAME
        );

        foreach ($langDirList as $dir) {
            self::$LANG_DIR = $dir;

            foreach (self::$ALLOW_LANG as $key => $lang) {
                foreach ($domainList as $domain) {
                    self::setLocale($lang, $domain);
                    _('test_lang_key_' . time());
                }
            }
        }
    }

    public static function getLocale()
    {
        $headers = self::getallheaders();
        return self::detectLocale(isset($headers['Locale']) ? $headers['Locale'] : null);
    }

    public static function setLocale($locale, $localeDomain)
    {
        setlocale(LC_MESSAGES, $locale);

        bindtextdomain($localeDomain, self::$LANG_DIR);
        textdomain($localeDomain);
        bind_textdomain_codeset($localeDomain, 'UTF-8');
    }

    public static function detectLocale($userLocale)
    {
        $locale = DEFAULT_LOCALE_ISO;

        if (isset(self::$ALLOW_LANG[$userLocale])) {
            $locale = $userLocale;
        }

        defined('CURRENT_LOCALE_ISO') or define('CURRENT_LOCALE_ISO', $locale);
        return self::$ALLOW_LANG[$locale];
    }

    public static function getallheaders()
    {
        if (!is_array($_SERVER)) {
            return array();
        }

        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

define('DEFAULT_LOCALE_ISO', 'en');
Locale::init();