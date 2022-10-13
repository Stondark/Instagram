<?php

namespace Stondark\Instagramtest\controllers;

use Stondark\Instagramtest\libs\Controller;
use Stondark\Instagramtest\models\User;

class Login extends Controller{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function auth(){
        $username = $this->post("username");
        $password = $this->post("password");

        if(!is_null($username) && !is_null($password)){
            if(User::exist($username)){
                $user = User::getUser($username);
                if($user->comparePassword($password)){
                    error_log("Usuario logueado");
                    $_SESSION["user"] = serialize($user); //Esta función permite transformar un objeto en un elemento que se pueda guardar
                    header("location: /instagram/home");
                } else{
                    error_log("Contraseña incorrecta");
                    header("location: /instagram/login");

                }

            } else{
                error_log("Usuario no encontrado");
                header("location: /instagram/login");
            }

        } else{
            error_log("Data incompleta");
            header("location: /instagram/login");
        }
    }

}