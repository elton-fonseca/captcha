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

            echo "provider";

            dd('asdas');
            return new Catpcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Config\Repository'],
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

    }
}