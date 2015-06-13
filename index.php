<?php

include "autoloader.php";

$application = new MVC();

$application->pathPrefix = '/LZSRestaurant';

$application->addRoute(GET, '', ['Restaurant', 'home']);
$application->addRoute(GET, 'index', ['Restaurant', 'home']);
$application->addRoute(GET, 'myorder', ['Restaurant', 'myOrder']);

$application->addRoute(GET, 'login', ['UserManager', 'login']);

$application->run();