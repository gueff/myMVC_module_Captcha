**this myMCVC module provides a captcha image you could use in your own html forms.** 

# Requirements

- Linux
- php >=7.4
- myMVC
    - myMVC 3.2.x: https://github.com/gueff/myMVC/tree/3.2.x
    - ZIP: https://github.com/gueff/myMVC/archive/refs/heads/3.2.x.zip
    - Doku: https://mymvc.ueffing.net/

_add a true type font file_
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
git clone https://github.com/gueff/myMVC_module_Captcha.git Captcha;
~~~


## How to use

_add the following route to your primary working Module_
~~~php
\MVC\Route::GET(
    '/captcha/',
    'module=Captcha&c=Index&m=index'
);
~~~

_create new captcha text in your Module's Controller and save to Session_  
~~~php
$sCaptchaText = \Captcha\Model\Index::createCaptchaText();
Session::is()->set('mymvc.captcha', $sCaptchaText);
~~~      

_Frontend Formular with Captcha image_    
~~~html
<form action="" method="post">
    <label for="captcha">Captcha</label>
    <img src="/captcha/">
    <input type="text"
           name="captcha"
           id="captcha" 
           class="form-control"
           value=""
           maxlength="5"
           placeholder="captcha code"
    >
</form>
~~~

_Get captcha Text in Module's Controller_  
~~~php
$sCaptcha = substr(
    preg_replace("/[^\\p{L}}\\p{N}']+/u", '', get($_POST['captcha'])),
    0,
    strlen(Session::is()->get('mymvc.captcha'))
);

if ($sCaptcha === Session::is()->get('mymvc.captcha'))
{
    // captcha is OK!
}
~~~
