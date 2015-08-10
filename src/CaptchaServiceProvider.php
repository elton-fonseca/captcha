<?php

namespace EltonFonseca\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /*
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('captcha', function($app)
        {

            return new Captcha (
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Session\Store']
            );

        });
    }

    /*
     * Bootstrap the application events
     *
     * return void
     */
    public function boot()
    {
        //Route for controller
        $this->app['router']->get('captcha/{width?}/{heigth?}', 
            ['as' => 'captcha', 'uses' => '\EltonFonseca\Captcha\CaptchaController@getCaptcha']);

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            return captcha_check($value);
        });

        // validator message    
        $this->app['validator']->replacer('attribute', function($message, $attribute, $rule, $parameters)
        {
            if($rule == 'validation.captcha'){
                return 'Por favor, some os dois números';
            }

            return $message;
        });

    }
}