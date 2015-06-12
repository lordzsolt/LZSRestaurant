<?php

include "autoloader.php";

$application = new MVC();

$application->pathPrefix = '/LZSRestaurant';

$application->addRoute(GET, '', ['Restaurant', 'home']);
$application->addRoute(GET, 'index.php', ['Restaurant', 'home']);

$application->run();