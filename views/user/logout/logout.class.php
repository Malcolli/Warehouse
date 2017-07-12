<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace warehouse_mvc\views\user\logout;

$page_title = "Logout";


class Logout extends \warehouse_mvc\views\user\UserIndexView {
    public function display($user, $confirm = "") {
        //display page header
        parent::displayHeader("Logout");
        session_start();
 
 //destroy the session data on disk
 session_destroy();
 
 //delete the session cookies
 setcookie(session_name(), '', time()-3600);
 
 //destroy the $_SESSION array
 $_SESSION = array();

 ?>

<h2>Logout</h2>
<p>Thank you for your visit. You are now logged out. </p>

<?php
    }
}

