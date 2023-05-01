<?php
/**
 * Index.php
 *
 * @package myMVC
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $CaptchaModel
 */
namespace Captcha\Model;

/**
 * Index
 */
class Index
{
    /**
     * Index constructor.
     */
	public function __construct ()
	{
		;
	}

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function createCaptchaText(int $iMax = 5)
    {
        $iMax = abs($iMax);
        ($iMax <= 0 || $iMax > 10) ? $iMax = 5 : false;

        // Captcha-Text erstellen
        $sChar = "abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ1234567890";
        $sText = "";

        for ($i = 0; $i < $iMax; $i++)
        {
            // Zufälligen Buchstaben auswählen
            $char = $sChar[rand(0, strlen($sChar) - 1)];
            $sText .= $char;
        }

        return $sText;
    }

	public function __destruct ()
	{
		;
	}	
}
