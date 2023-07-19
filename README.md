**this myMVC module provides a captcha image you could use in your own html forms.** 

# Requirements

- Linux
- php >=7.4
- myMVC
    - myMVC
      - 3.2.x: https://github.com/gueff/myMVC/tree/3.2.x
      - works with 3.3.x too, but requires PHP >=8.0 then
      - Doku: https://mymvc.ueffing.net/
- **add a true type font file**
  - copy your licensed copy of a true type font like "Andale Mono" (example: `anadalemo.ttf`)
    into the root folder of this module
  - rename that file to `font.ttf`

---

## Install

_cd into the modules folder of your `myMVC3.2.x` copy; e.g.:_  
~~~bash
cd /var/www/myMVC/modules/;
~~~

_clone `myMVC_module_Captcha` as `Captcha`_
~~~bash
git clone --branch 1.0.x https://github.com/gueff/myMVC_module_Captcha.git Captcha;
~~~


## How to use

**1.** _add the following route to your primary working Module_

~~~php
// captcha route
\MVC\Route::GET(
    \Captcha\Model\Index::$sRoute,
    '\Captcha\Controller\Index::index'
);
~~~

**2.** _add captcha check and creation in your primary working Module's Controller_

~~~php
// check if captcha is valid
if (true === \Captcha\Model\Index::captchaIsValid())
{
    // captcha is OK!
}

// create captcha for new
$sCaptchaText = \Captcha\Model\Index::createCaptcha();
~~~

**3.** _add this captcha Formular to your Frontend template_

~~~html
<form action="" method="post">

  <!-- captcha -->
  <label for="captcha">Captcha</label>
  <img src="{Captcha\Model\Index::$sRoute}">
  <input type="text"
         name="{Captcha\Model\Index::$sPostFieldName}"
         maxlength="{Captcha\Model\Index::$iCaptchaTextLength}"
         value=""
         placeholder="captcha code"
         autofocus
  >
  <!-- /captcha -->

  <button type="submit">submit</button>
</form>
~~~

---

🛈 Note: **make sure your Route allows `POST` method**

allow `POST` method in Routes you want to make use of Captcha.

~~~
\MVC\Route::MIX(
    ['GET', 'POST'],
    '/',
    '\Foo\Controller\Index::index',
    $oDTRoutingAdditional->getPropertyJson()
);
~~~

## Customizing

In your primary Module's environment config file simply change 
the properties of the Captcha Model Class.

_Here is an Example_  
~~~php
//-------------------------------------------------------------------------------------
// Module Captcha

// load Class
require_once $aConfig['MVC_MODULES_DIR'] . '/Captcha/Model/Index.php';

// declare a custom route
\Captcha\Model\Index::$sRoute = '/captcha/MyFormularXY/';

// add some extra chars to choose from...
\Captcha\Model\Index::$sChar.= '_!=)(/&%$[].:,;+*~#';
// ...if you changed the $sChar, do not forget to adjust sanitizing rule
\Captcha\Model\Index::$sCharSanitizePattern = "/[^\\p{L}}\\p{M}\\p{S}\\p{N}\\p{P}']+/u";

// auto-name template input var (name="") like Route
\Captcha\Model\Index::$sPostFieldName = str_replace('/', '', \Captcha\Model\Index::$sRoute);

// set SessionName like $sPostFieldName
\Captcha\Model\Index::$sSessionName = \Captcha\Model\Index::$sPostFieldName;
~~~
