<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 12/06/2015
 * Time: 23:20
 */

define ('GET', 'GET');
define ('POST', 'POST');
define ('SPEC', 'SPECIAL');

class MVC {

    protected $routes;

    public $pathPrefix;

    public $view;

    public $database;

    function __construct() {
        $this->routes = [
            GET => [],
            POST => [],
            SPEC => []
        ];

        $this->view = new MVCView();
    }

    public function addRoute($method, $path, $handler) {
        //TODO: Test $method
        $this->routes[$method][$path] = $handler;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];

        if (isset($this->pathPrefix)) {
            if (substr($path, 0, strlen($this->pathPrefix)) == $this->pathPrefix) {
                $path = substr($path, strlen($this->pathPrefix));
                $path = trim($path, '/');
            }
        }
        echo $path;

        $handler = $this->getHandler($method, $path);
        if ($handler === null) {
            header('HTTP/1.0 404 Not Found', true, 404);
            if (isset($this->routes[SPEC][404])) {
                $handler = [$this->routes[SPEC][404], [$path]];
            }
            else {
                throw new Exception('No handler found for "'.$method.'" "'.$path.'" nor was a 404 handler available.');
            }
        }

        $class = $handler[0][0];
        $method = $handler[0][1];

        if (!class_exists($class)) {
            throw new Exception('Class "'.$class.'" does not exist.');
        }

        $controller = new $class($this);
        if (!method_exists($controller, $method)) {
            throw new Exception('Class "'.$class.'" does not have method "'.$method.'".');
        }

        $controller->$method();
    }

    private function getHandler($method, $path) {
        if (isset($this->routes[$method][$path])) {
            return [$this->routes[$method][$path]];
        }
        return null;
    }
}