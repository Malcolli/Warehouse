<?php
/*
 * Author: Louie Zhu
 * Date: Dec 6, 2014
 * File: welcome_controller.class.php
 * Description: This scripts define the class for the welcome controller; this is the default controller.
 * 
 */
namespace warehouse_mvc\controllers;

class WelcomeController {
    //put your code here
    public function index() {
        $view = new \warehouse_mvc\views\welcome\Index();
        $view->display();
    }
}