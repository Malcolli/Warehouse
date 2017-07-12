<?php

/* Author: Malcolm Collins
 * Date: 04/25/2015
 * Name: utilities.class.php
 * Description: this class contains two static methods for validating email address and date.
 */
 
class Utilities {
    //validate an email address. An valid email address appears in the format of "username@domain.domain". It returns a boolean value.
    public static function checkemail($email) {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }

//validate a date. A valid date must be entered in 'mm/dd/yyyy' or 'mm-dd-yyyy' format. It returns a boolean value.
    public static function validatedate($date) {
        list( $m, $d, $y ) = preg_split('/[-\.\/ ]/', $date);
        if (!is_numeric($m) || !is_numeric($d) || !is_numeric($y) || $y < 1000 || $y > 9999)
            return FALSE;
        return checkdate($m, $d, $y);
    }

}