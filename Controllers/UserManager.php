<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 17:11
 */

class UserManager extends MVCControllerBase {

    public static function getCookieInfo() {
        $user = $_SESSION['user'];
        return [
            'userId' => $user['userId'],
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'userType' => $user['userType']
        ];
    }

    public function login() {
        $this->loginWithError();
    }

    private function loginWithError($error = null) {
        parent::createPageWithContent(null,
            function () use ($error) {
                $this->application->view->create('login', ['error' => $error]);
            });
    }

    public function performLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stubUser = new User($this->application);
        $result = $stubUser->getUserWithCredentials($username, $password);

        if (count($result) == 0) {
            $error = 'Incorrect identifier or password.<p>';
            goto endOfFunction;
        }

        endOfFunction:
        if (isset($error)) {
            $this->loginWithError($error);
        }
        else {
            $cookieInfo =  $result->getCookieInfo();
            $_SESSION['user'] = $cookieInfo;
            parent::createPageWithContent($cookieInfo,
                function () {
                    $this->application->view->create('menu', null);
                    $this->application->view->create('news', null);
                });
        }
    }

    public function register() {
        $this->registerWithError();
    }

    private function registerWithError($error = null) {
        parent::createPageWithContent(null,
            function () use ($error) {
                $this->application->view->create('register', ['error' => $error]);
            });
    }

    public function performRegister() {
        $error = null;

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rePassword = $_POST['rePassword'];

        $error = $this->validateInput($username, $email, $password, $rePassword);
        if (!is_null($error)) {
            goto endOfFunction;
        }

        $stubUser = new User($this->application);
        $result = $stubUser->getAllWhere('username = ?', [$username]);
        if (count($result) > 0) {
            $error = 'Username already taken';
            goto endOfFunction;
        }

        $result = $stubUser->getAllWhere('email = ?', [$email]);
        if (count($result) > 0) {
            $error = 'Email address already registered';
            goto endOfFunction;
        }

        $user = User::createWithParameters($this->application, null, $username, $password, $email, null, null, 0);
        if (!$user->save()) {
            $error = 'An error occurred while registering. Please try again.';
            goto endOfFunction;
        }

        endOfFunction:
        if (!is_null($error)) {
            $this->registerWithError($error);
            return;
        }

        //TODO: Show success form
    }

    public function performLogout() {
        $_SESSION['user'] = null;
        parent::createPageWithContent(null,
            function () {
                $this->application->view->create('menu', null);
                $this->application->view->create('news', null);
            });
    }

    private function validateInput($username, $email, $password, $rePassword) {
        $error = null;

        if (empty($username) || empty($email) || empty($password) || empty($rePassword)) {
            $error .= 'Please complete all fields.<p>';
        }

        if (preg_match('/[^a-zA-Z0-9_]/', $username) > 0) {
            $error .= 'Username contains invalid characters.<p>';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= 'Invalid email address.<p>';
        }

        if ($password != $rePassword) {
            $error .= 'Passwords must match.<p>';
        }

        if( strlen($password) < 8 ) {
            $error .= "Password too short!<p>";
        }

        if( !preg_match("#[0-9]+#", $password) ) {
            $error .= "Password must include at least one number!<p>";
        }

        if( !preg_match("#[a-zA-Z]+#", $password) ) {
            $error .= "Password must include at least one letter!<p>";
        }

        if( !preg_match("#[A-Z]+#", $password) ) {
            $error .= "Password must include at least one uppercase letter!<p>";
        }

        return $error;
    }
}