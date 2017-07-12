<?php

/*
 * Author: Louie Zhu
 * Date: Dec. 26, 2014
 * Name: autoloader.class.php
 * Description: This script registers an auto load method that can automatically loads class file when an object is instantiated.
 * This autoloader works only if namespaces are used.
 */

namespace warehouse_mvc\application;

//extension of class files
const CLASS_EXTENTION = ".class.php";

class Autoloader {
    static private $_instance = NULL;
       
    /*
     * constructor to set autoloader
     * To use singleton patter, the constructor is made private. The getAutoloader method must be called to get an instance of the classs.
     */
    private function __construct() {
        spl_autoload_register(array('self', 'autoload'));
    }
    
    
    //NOT 100% SURE IF WE WILL NEED THIS LINE OF CODE SINCE WE ARE MODELING THE SAME CATEGORIES
    //static method to ensure there is just one MovieManager instance
    public static function getAutoloader() {
        if (self::$_instance == NULL) {
            self::$_instance = new Autoloader();
        }
        return self::$_instance;
    }
    
    // Automatically load the file that contains class definition
    public static function autoload($class) {
        $namespaces = explode('\\', $class);
        if (count($namespaces) > 1) {
            array_shift($namespaces);  //remove the root folder
            $namespaces[count($namespaces) - 1] = self::camelCaseToUnderscore($namespaces[count($namespaces) - 1]);  //convert camelCase file name to underscored
            $classFile = __DIR__ . '/..' . DIRECTORY_SEPARATOR . implode('/', $namespaces) . CLASS_EXTENTION; //determine the class file path

            if (is_readable($classFile)) {
                require_once($classFile);
            }
        }
    }

    // Convert a camel case string to underscores (eg: camelCase becomes camel_case)
    private static function camelCaseToUnderscore($str) {
        //store all characters in an array
        $characters = str_split($str);

        //lowercase the first character
        $characters[0] = strtolower($characters[0]);

        //exam all characters in the array
        //if a character is uppercase, replace it with a lowercase and prefix it with an underscore
        foreach ($characters as &$character) {
            if (ord($character) >= ord('A') && ord($character) <= ord('Z'))
                $character = '_' . strtolower($character);
        }

        //conver all elements in the array into a string and return the string
        return implode('', $characters);
    }
}

//Instantiate Autoloader class to register the autoload method
Autoloader::getAutoloader();