<?php

/* Author: Malcolm Collins
 * Date: 04/25/2015 
 * Name: Date Exception.class.php
 * Purpose: This class handles date exception issue message.
 */

class DateException extends Exception {
    
    public function displayError($message) {
        $view = new Error();
        return $view->display($message);
    }
}

?>
