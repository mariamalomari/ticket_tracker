<?php

require_once "../models/User.php";

class AuthenticationController {

    //error after post request(get request with error)
    public function showLoginPage($error) {
        if ($error == "loginFailed") {
            $message = 'Your email or password is incorrect.';
        } else if ($error == "error_csrf") {
            $message = 'CSRF token validation failed';
        } else {
            $message = null;
        }
        require_once '../views/login.php'; //this is to send the html to the browser, message variable will be in scope
    }


    //post request
    public function loginUser($data) {

        $csrf_token = $data['csrf_token'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!verifyCSRFtoken($csrf_token)) {
            $this->showLoginPage("error_csrf");
            exit();
        }

        $userModel = new User();
        if ($userModel->verifyCombination($email, $password)) {
            //regenerating session ID on logins
            session_regenerate_id(true);

            $userInfo = $userModel->getUserInfoByEmail($email);
            $_SESSION["user_id"] = $userInfo["id"];
            $_SESSION["is_admin"] = $userInfo["is_admin"];
            header("Location: ../public/dashboard.php");
            exit();
        } else {
            header("Location: ../public/login.php?error=loginFailed");
            exit();
        }
    }


    //error after post request(get request with error)
    public function showSignupPage($error) {
        switch ($error) {
            case 'invalidEmail':
                $message = 'Please provide a valid email address.';
                break;
            case 'invalidPassword':
                $message = 'Password must be at least 8 letters, include a lowercase, uppercase letter and a number.';
                break;
            case 'passwordMatch':
                $message = 'Please make sure your passwords match.';
                break;
            case 'alreadyRegistered':
                $message = 'Email is already in use. Please login or register with another email.';
                break;
            case 'stmtfailed':
                $message = 'Something went wrong, please try again later.';
                break;   
            case 'error_csrf':
                $message = 'CSRF validation failed.';
                break;
            default:
                $message = null;
                break;
        }
        require_once '../views/signup.php'; //ask jaser if this is the right approach? 
    }

    private function invalidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    } 

    private function invalidPassword($password) {
        if (strlen($password) < 8) {
            return true;
        }
        if (!preg_match("/[A-Z]/", $password)) {
            return true;
        }
        if (!preg_match("/[a-z]/", $password)) {
            return true;
        } if (!preg_match("/[0-9]/", $password)) {
            return true;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) { //no special characters
            return true;
        }
        return false;
    }

    private function confirmRepeatedPasswordMatch($password, $repeatedPassword) {
        if ($repeatedPassword === $password) {
            return true;
        }
        return false;
    }

    //post request
    //checks for any input errors, redirecting to signup page with an error message if necessary
    //else uses model instance to add user to db
    public function registerUser($data) {
        
        $email = $data["email"] ?? '';
        $password = $data["password"] ?? '';
        $repeatedPassword = $data["repeatedPassword"] ?? '';
        $csrf_token = $data['csrf_token'] ?? '';

        if (!verifyCSRFtoken($csrf_token)) {
            $this->showSignupPage("error_csrf");
            exit();
        }

        
        if ($this->invalidEmail($email)) {
            header("Location: ../public/signup.php?error=invalidEmail");
            exit();
        } 
        
        if ($this->invalidPassword($password)) {
            header("Location: ../public/signup.php?error=invalidPassword");
            exit();
        }

        if (!$this->confirmRepeatedPasswordMatch($password, $repeatedPassword)) {
            header("Location: ../public/signup.php?error=passwordMatch");
            exit();
        }


        $userModel = new User();
        //is email already registered?
        if ($userModel->alreadyRegistered($email)) {
            header("Location: ../public/signup.php?error=alreadyRegistered");
            exit();
        }

        if ($userModel->addUser($email, $password)) {
            $userInfo = $userModel->getUserInfoByEmail($email);
            $_SESSION["user_id"] = $userInfo["id"];
            $_SESSION["is_admin"] = $userInfo["is_admin"];

            header("Location: ../public/dashboard.php");
            exit();
        } else {
            header("Location: ../public/signup.php?error=stmtfailed");
            exit();
        }
    }

    public function logout() {
        //clears the memory variables of $_SESSION
        session_unset();

        //deletes the session file from server
        session_destroy();

        setcookie(session_name(), "", [ //second argument is setting cookie to empty
            'expires' => time() - 3600,
            // 'domain' => 'localhost',
            'path' => '/',
            'secure'=> false , //for development only false cuz using xampp not https
            'httponly' => true 
        ]); //session_name - name of the current php session
        //removing a cookie by setting an expiration time that has already passed (e.g., time() - 3600).

        header("Location: login.php");
        exit();
    }

}