<?php

namespace EltonFonseca\Captcha;

use Illuminate\Routing\Controller;

class CaptchaController extends Controller
{
    /**
     * get CAPTCHA
     *
     * @param \Mews\Captcha\Captcha $captcha
     * @param string $config
     * @return ImageManager->response
     */
    public function getCaptcha(Captcha $captcha, $width, $heigth)
    {
        return $captcha->generate($width, $heigth);
    }
}