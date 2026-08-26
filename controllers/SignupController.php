<?php

require_once "../models/User.php";

class SignupController {

    public function __construct() {
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
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
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
    public function registerUser($email, $password, $repeatedPassword) {
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
            $userID = $userModel->getUserInfoByEmail($email)["id"];
            $_SESSION["user_id"] = $userID;
            header("Location: ../public/dashboard.php");
            exit();
        } else {
            header("Location: ../public/stmtfailed.php");
            exit();
        }
    }
}