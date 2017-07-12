<?php

/*
 * Author: Louie Zhu
 * Date: December 17, 2014
 * File: database,class.php
 * Description: Description: the Database class sets the database details.
 * 
 */
namespace warehouse_mvc\application;

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'warehouse_db',
        'tblFurniture' => 'furnitures',
        'tblElectronic' => 'electronics',
        'tblUser' => 'users',
        'tblFurnitureCategory' => 'furniture_categories',
        'tblElectronicCategory' => 'electronic_categories'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        $this->objDBConnection = @new \mysqli(
                        $this->param['host'],
                        $this->param['login'],
                        $this->param['password'],
                        $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores movies
    public function getFurnitureTable() {
        return $this->param['tblFurniture'];
    }

    //returns the name of the table that stores books
    public function getElectronicTable() {
        return $this->param['tblElectronic'];
    }
     //returns the name of the table that stores books
    public function getUserTable() {
        return $this->param['tblUser'];
    }
    
    
    //returns the name of the table storing movie ratings
    public function getFurnitureCategoryTable() {
        return $this->param['tblFurnitureCategory'];
    }
    
    //return the name of the table that stores book categories
    public function getElectronicCategoryTable() {
        return $this->param['tblElectronicCategory'];
    }
}