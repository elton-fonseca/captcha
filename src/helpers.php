<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 7/23/15
 * Time: 17:59
 */

if ( ! function_exists('captcha')) {
    function captcha($width=250, $heigth=70)
    {
        return app('captcha')->generate($width, $heigth);
    }
}

if ( ! function_exists('captcha_src')) {
    function captcha_src($width=250, $heigth=70)
    {
        return app('captcha')->getSrc($width, $heigth);
    }
}

if ( ! function_exists('captcha_img')) {
    function captcha_img($width=100, $heigth=35)
    {
        return app('captcha')->getImg($width, $heigth);
    }
}

if ( ! function_exists('captcha_check')) {
    function captcha_check($value)
    {
        return app('captcha')->check($value);
    }
}