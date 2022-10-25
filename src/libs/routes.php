<?php

use Stondark\Instagramtest\controllers\Home;
use Stondark\Instagramtest\controllers\Signup;
use Stondark\Instagramtest\controllers\Login;

$router = new \Bramus\Router\Router();

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config');
$dotenv->load();

$router->get("/", function() {
    echo "Inicio";

}); 

$router->get("/login", function() {
    $controller = new Login;
    $controller->render("login/index");
});

$router->get("/signup", function() {
    $controller = new Signup;
    $controller->render("signup/index");
});

$router->get("/home", function() {
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});

$router->get("/profile", function() {
    echo "Profile";
});


$router->get("/invalid", function() {
    echo "Error";
});

$router->post("/register", function() {
    $controller = new Signup;
    $controller->register();
});

$router->post("/addLike", function() {
    echo "Inicio";
});

$router->post("/auth", function() {
    $controller = new Login;
    $controller->auth();
});

$router->post("/publish", function() {
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->store();
});



$router->run();