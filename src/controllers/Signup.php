<?php

namespace Stondark\Instagramtest\controllers;

use Stondark\Instagramtest\libs\Controller;
use Stondark\Instagramtest\libs\UtilImages;
use Stondark\Instagramtest\models\User;

Class Signup extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function register(){
        $username = $this->post("username");
        $password = $this->post("password");
        $profile = $this->file("profile");

        if( !is_null($username) &&
            !is_null($password) && 
            !is_null($profile)
        ){
            $pictureName = UtilImages::StoreImage($profile);
            $user = new User($username, $password);
            $user->setProfile($pictureName);
            error_log("Usuario $username creado");
            $user->save() ? header("location: /Instagram/login") : header("location: /Instagram/invalid");

        }else{
            $this->render("errors/index");
        }

    }

}