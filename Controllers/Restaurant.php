<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 02:13
 */

class Restaurant extends MVCControllerBase  {

    public function home() {
        parent::createPageWithContentLambda(function () {
            $this->application->view->create('menu', null);
            $this->application->view->create('news', null);
        });
    }
}