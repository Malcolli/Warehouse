<?php

/*
 * Author: Louie Zhu
 * Date: Oct 26, 2014
 * File: electronic_model.class.php
 * Description: the electronic model
 * 
 */

namespace warehouse_mvc\models;

class UserModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUser;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getElectronicModel method must be called.
    private function __construct() {
        session_start();
        $this->db = \warehouse_mvc\application\Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUser = $this->db->getUserTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        
        //initialize USER category
        $username= '';
        $password= '';
        $login_status= 2;

    if(isset($_POST['username']))
        $username= trim($_POST['username']);
    if(isset($_POST['password']))
        $password= trim($_POST['password']);
    }

    //static method to ensure there is just one Electronic Model instance
    public static function getUserModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
    
    public function create_user($id) {
    //start the session
    session_start();
   
        $id = null;
        $firstname = isset($_POST['firstname']) && trim(($_POST['firstname'] != "")) ? trim($_POST['firstname']) : null;
        $lastname = isset($_POST['lastname']) && $_POST['lastname'] != "" ? $_POST['lastname'] : null;
        $username = isset($_POST['username']) && trim($_POST['username'] != "") ? trim($_POST['username']) : null;
        $password = isset($_POST['password']) && $_POST['password'] != "" ? $_POST['password'] : null;
        $role = 2;
        //make sure none of them are null
        if ($firstname && $lastname  && $username &&  $password) {
            //query string for update 
            $sql = "INSERT " . $this->tblUser .
                    " SET id='$id', firstname='$firstname', lastname='$lastname', username='$username', password='$password'"
                    . " WHERE id='$id'";
            
            //execute the query
            return $this->dbConnection->query($sql);
        }
        return false;
    
 
    //Handle selection errors
    if (!$result) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Insertion failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
    }
    $conn->close();

    //create session variables
    $_SESSION['login'] = $username;
    $_SESSION['name'] = $firstname." ".$lastname;
    $_SESSION['role'] = 2;

    //set login status to 3 since this is a new user.
    $login_status=3;
    }

    public function login_user() {
       if(!empty($username)) {
    //The SQL select statement
    $query_str= "SELECT * FROM users WHERE
            username='$username' AND password='$password'";
    
    //execute the query
    $result = @$conn->query($query_str);
    if ($result -> num_rows) {
        //It is a valid user. Need to store the user in the session variables.
        session_start();
        $_SESSION['login'] = $username;
        $result_row =$result->fetch_assoc();
        $_SESSION['role']=$result_row['role'];
        $_SESSION['name']=$result_row['firstname']." ".$result_row['lastname'];
        
        //update the login status
        $login_status=1;
    
    }
   }
  }
  
  public function logout_user() {
    session_start();
 
    //destroy the session data on disk
    session_destroy();
 
    //delete the session cookies
    setcookie(session_name(), '', time()-3600);
 
    //destroy the $_SESSION array
    $_SESSION = array();
    
  }
}