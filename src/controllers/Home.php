<?php

namespace Stondark\Instagramtest\controllers;

use Stondark\Instagramtest\libs\Controller;
use Stondark\Instagramtest\models\User;

class Home extends Controller{
    
    public function __construct(private User $user)
    {
        parent::__construct();
    }

    public function index(){
        $this->render("home/index", ['user' => $this->user]);
    }

}