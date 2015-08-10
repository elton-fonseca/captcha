<?php

namespace EltonFonseca\Captcha;

use Illuminate\Hashing\BcryptHasher as Hasher;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Illuminate\Session\Store as Session;

class Captcha {

    protected $fileSystem;

    protected $hasher;

    protected $imageManager;

    protected $session;

    protected $canvas;

    protected $date;


    public function __construct(Filesystem $fileSystem, Hasher $hasher, ImageManager $imageManger, Session $session ){
        $this->fileSystem = $fileSystem;
        $this->hasher = $hasher;
        $this->imageManager = $imageManger;
        $this->session = $session;
    }

    public function generate($width, $height){
        $this->date['numberOne'] = $this->getNumber();
        $this->date['operation'] = "+";
        $this->date['numberTwo'] = $this->getNumber();

         $this->canvas = $this->imageManager->canvas(
             $width,
             $height
         );

         $this->insertInImage($width, $height);

         $this->insertInSession();


         return $this->canvas->response('png', 90);
    }

    private function getNumber(){
        return mt_rand(0, 9);
    }

    private function insertInImage($width, $height){
        $length = $height * 0.8;
        $marginTop = $height * 0.1;
        $marginLeft = $width * 0.1;

        foreach($this->date as $key => $value)
        {    
        
            $this->canvas->text($value, $marginLeft, $marginTop, function($font) {
                $font->file(__DIR__ . '/../assets/fonts/ABeeZee_regular.ttf');
                $font->size(20);
                $font->color($this->getFontColor());
                $font->align('left');
                $font->valign('top');
                $font->angle($this->getAngle());
            });
                
            $marginLeft += $width * 0.3;
            


         }        

    }

    private function getFontColor(){

        return [rand(0, 255), rand(0, 255), rand(0, 255)];
    }

   protected function getAngle(){

        return rand(-15, 15);
   }

   protected function insertInSession(){

        $result = $this->date['numberOne'] + $this->date['numberTwo'];

        $this->session->put('captcha', $this->hasher->make($result));
   }

    public function check($value)
    {
        $store = $this->session->get('captcha');
       
        return $this->hasher->check($value, $store);
    }

    /**
     * @param null $config
     * @return string
     */
    public function getSrc($width, $height)
    {
        return route('captcha', ['width'=>$width, 'height'=>$height]);
    }
    /**
     * @param null $config
     * @return string
     */
    public function getImg($width, $height)
    {
        return '<img src="' . $this->getSrc($width, $height) . '" alt="captcha">';
    }


}