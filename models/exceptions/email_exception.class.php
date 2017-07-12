<?php

/* Author: Malcolm Collins
 * Date: 04/25/2015
 * Name: email exception class.php
 * Purpose: handles error for email exception class
 */

class EmailException extends Exception {
    
    public function displayError($message) {
        $view = new Error();
        return $view->display($message);
    }
}

?>
