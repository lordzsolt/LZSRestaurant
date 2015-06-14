<?php

include "autoloader.php";

define('SERVER_NAME', 'localhost');
define('DATABASE_NAME', 'lzsrestaurant');
define('DATABASE_USER_NAME', 'restaurant');
define('DATABASE_PASSWORD', 'randompassword');

$application = new MVC();

$application->database = new Database(SERVER_NAME, DATABASE_NAME, DATABASE_USER_NAME, DATABASE_PASSWORD);

$application->pathPrefix = '/LZSRestaurant';

$application->addRoute(GET, '', ['Restaurant', 'home']);
$application->addRoute(GET, 'index', ['Restaurant', 'home']);
$application->addRoute(GET, 'myorder', ['Restaurant', 'myOrder']);

$application->addRoute(GET, 'login', ['UserManager', 'login']);
$application->addRoute(POST, 'login', ['UserManager', 'performLogin']);
$application->addRoute(GET, 'register', ['UserManager', 'register']);
$application->addRoute(POST, 'register', ['UserManager', 'performRegister']);
$application->addRoute(POST, 'logout', ['UserManager', 'performLogout']);
$application->addRoute(GET, 'myinfo', ['UserManager', 'userInfo']);

$application->addRoute(GET, 'admin', ['Administration', 'main']);

$application->run();