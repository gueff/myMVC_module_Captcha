<?php

/**
 * @name $CaptchaModel
 */
namespace Captcha\Model;

use MVC\Debug;
use MVC\Session;

/**
 * Index
 */
class Index
{
    /**
     * @var string
     */
    public static $sRoute = '/captcha/';

    /**
     * @var string char library
     */
    public static $sChar = "abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ1234567890";

    /**
     * default sanitizing rule matches to letters and numbers only
     * @var string sanitize pattern
     */
    public static $sCharSanitizePattern = "/[^\\p{L}}\\p{N}']+/u";

    /**
     * @var string POST field name
     */
    public static $sPostFieldName = 'captcha';

    /**
     * @var string Session var name
     */
    public static $sSessionName = 'mymvc.captcha';

    /**
     * @var int
     */
    public static $iCaptchaTextLength = 5;

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function createCaptcha()
    {
        // create captcha text
        $sText = "";

        for ($i = 0; $i < self::$iCaptchaTextLength; $i++)
        {
            // choose random letters
            $sChar = self::$sChar[rand(0, strlen(self::$sChar) - 1)];
            $sText.= $sChar;
        }

        Session::is()->set(
            self::$sSessionName,
            $sText
        );

        return $sText;
    }

    /**
     * @return string captcha
     * @throws \ReflectionException
     */
    public static function getCaptchaPost()
    {
        return (string) substr(
            (string) preg_replace(
                self::$sCharSanitizePattern,
                '',
                get($_POST[self::$sPostFieldName], ''))
            ,
            0,
            strlen(Session::is()->get(self::$sSessionName))
        );
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getCaptchaSession()
    {
        return Session::is()->get(self::$sSessionName);
    }

    /**
     * @return bool valid
     * @throws \ReflectionException
     */
    public static function captchaIsValid()
    {
        return (self::getCaptchaPost() === self::getCaptchaSession());
    }
}
