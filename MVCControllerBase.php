<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 01:29
 */

class MVCControllerBase {

    public $application;

    function __construct($app) {
        if (!isset($app) || !is_a($app, 'MVC')) {
            throw new \Exception('The $app argument should point to a valid MVC application.');
        }
        $this->application = $app;
    }

}