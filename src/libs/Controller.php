<?php

namespace Stondark\Instagramtest\libs;

use Stondark\Instagramtest\libs\View;

class Controller{

    private View $view;

    public function __construct(){
        $this->view = new View();
    }

    public function render(string $name, array $data = []){
        $this->view->render($name, $data);
    }

    protected function post(string $param){
        if(!isset($_POST[$param])){
            return NULL;
        }
        return $_POST[$param];
    }

    protected function get(string $param){
        if(!isset($_GET[$param])){
            return NULL;
        }
        return $_GET[$param];
    }

    protected function file(string $param){
        if(!isset($_FILES[$param])){
            return NULL;
        }
        return $_FILES[$param];
    }

}
