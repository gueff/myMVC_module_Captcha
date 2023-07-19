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
 * @name $CaptchaController
 */
namespace Captcha\Controller;

use MVC\Session;

/**
 * Index
 * @implements \MVC\MVCInterface\Controller
 */
class Index implements \MVC\MVCInterface\Controller
{
    /**
     * @return void
     */
    public static function __preconstruct ()
    {
        ;
    }
	
    /**
     * Index constructor.
     * @throws \ReflectionException
     * @throws \SmartyException
     */
	public function __construct ()
	{

	}

    /**
     * @return void
     * @throws \ReflectionException
     */
	public function index ()
    {
        if (true === empty(Session::is()->get(\Captcha\Model\Index::$sSessionName)))
        {
            return false;
        }

        $iWidth = 150;
        $iHeight = 50;
        $oGdImage = imagecreatetruecolor($iWidth, $iHeight);
        imagealphablending($oGdImage, true);
        imagesavealpha($oGdImage, true);
        $iBgColor = imagecolorallocatealpha($oGdImage, 255, 255, 255, 127);
        imagefill($oGdImage, 0, 0, $iBgColor);
        $sAbsPathToFont = realpath(__DIR__ . '/../') . '/font.ttf';
        $iSize = 15;
        $iColor = imagecolorallocate($oGdImage, 0, 0, 0);

        // get Text from Session
        $sText = Session::is()->get(\Captcha\Model\Index::$sSessionName);

        for ($i = 0; $i < strlen($sText); $i++)
        {
            $char = $sText[$i];
            imagettftext($oGdImage, $iSize, 0, 10 + $i * 30, 35, $iColor, $sAbsPathToFont, $char);
        }

        header("Content-Type: image/png");
        imagepng($oGdImage);
        imagedestroy($oGdImage);
    }

    /**
     * @throws \ReflectionException
     * @throws \SmartyException
     */
	public function __destruct ()
	{
	}
}