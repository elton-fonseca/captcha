<?php

namespace EltonFonseca\Captcha;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Illuminate\Session\Store as Session;

class Captcha {

    protected $fileSystem;

    protected $config;

    protected $imageManager;

    protected $session;


    public function __construct(Filesystem $fileSystem, Repository $config, ImageManager $imageManger, Session $session ){
        $this->fileSystem = $fileSystem;
        $this->config = $config;
        $this->imageManager = $imageManger;
        $this->session = $session;
    }

    public function generate(){
        echo "<br>dentro do generete<br>";
    }


}