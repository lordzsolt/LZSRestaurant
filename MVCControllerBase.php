<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 01:29
 */

abstract class MVCControllerBase {

    public $application;

    function __construct($app) {
        if (!isset($app) || !is_a($app, 'MVC')) {
            throw new Exception('The $app argument must point to a valid MVC application.');
        }
        $this->application = $app;
    }

    protected function createPageWithContent($parameters, $method) {
        $this->application->view->create('header', $parameters);

        $this->beginContainer();
        if (!is_null($method)) {
            $method();
        }
        $this->endContainer();

        $this->application->view->create('footer', $parameters);
    }

    public function beginContainer() {
        echo '<div class="container"> <div class="row">';
    }

    public function endContainer() {
        echo '</div> </div>';
    }
}