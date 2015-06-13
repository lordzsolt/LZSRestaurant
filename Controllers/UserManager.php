<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 17:11
 */

class UserManager extends MVCControllerBase {


    public function login() {
        parent::createPageWithContent(null);
    }

    public function register() {
        parent::createPageWithContent(function () {
            $this->application->view->create('register');
        });
    }

    public function performRegister() {

    }

}