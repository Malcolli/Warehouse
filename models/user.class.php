<?php
/*
 * Author: Louie Zhu
 * Date: Jan 1, 2015
 * Name: electronic.class.php
 * Description: the Electronic class models a real-world electronic.
 */
namespace warehouse_mvc\models;

class User {
    
    //private properties of a Electronic object
    private $id, $firstname, $lastname, $username, $password, $role;
    
    //the constructor that initializes all properties
    public function __construct($id, $firstname, $lastname, $username, $password, $role) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
    /////////////////////************************CONTINUE HERE*********************************
    //get the id of a electronic
    public function getId() {
        return $this->id;
    }
	
	//get the title of a electronic
    public function getFirstName() {
        return $this->firstname;
    }

	//get the Category of a electronic
    public function getLastName() {
        return $this->lastname;
    }
	
	//get the category of a electronic
    public function getUserName() {
        return $this->username;
    }

	//get the publish date of a electronic
    public function getPassword() {
        return $this->password;
    }

	//get the image file name of a electronic
    public function getRole() {
        return $this->role;
    }
    
    //set electronic id
    public function setId($id) {
        $this->id = $id;
    }
}
