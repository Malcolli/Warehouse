<?php
/*
 * Author:
 * Date: 
 * File: electronic_controller.class.php
 * Description:
 *
 */

namespace warehouse_mvc\controllers;

//namesapce alias
use \warehouse_mvc\views\user as user;

class UserController {

    private $user_model;

    //default constructor
    public function __construct() {
        //create an instance of the ElectronicModel class
        $this->user_model = \warehouse_mvc\models\UserModel::getUserModel();
    }
    
    public function create($id) {
         //create a login 
        $user = $this->user_model->create_user($id);

        if (!$user) {
            //display an error
            $message = "There was a problem creating the user id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new user\create\Create();
        //$view->display($user);
    
    }
    
    public function login() {
        //login the user
        $user = $this->user_model->login_user();
        //handle errors
        if($user) {
            $message = "There was a problem updating the user id='" . $id . "'.";
            $this->error($message);
            return;
        }
    }
    
    public function logout($id) {
        //login the user
        $logout = $this->user_model->logout_user($id);
        //handle errors
        if($logout) {
            $message = "You have successfully logged out as id='" . $id . "'.";
            $this->error($message);
            return;
        }
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new user\error\Error();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

}