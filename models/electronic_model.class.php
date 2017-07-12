<?php

/*
 * Author: Louie Zhu
 * Date: Oct 26, 2014
 * File: electronic_model.class.php
 * Description: the electronic model
 * 
 */

namespace warehouse_mvc\models;

class ElectronicModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblElectronic;
    private $tblElectronicCategory;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getElectronicModel method must be called.
    private function __construct() {
        session_start();
        $this->db = \warehouse_mvc\application\Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblElectronic = $this->db->getElectronicTable();
        $this->tblElectronicCategory = $this->db->getElectronicCategoryTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        
        //initialize Electronic category
        if (!isset($_SESSION['electronic_categories'])) {
            $categories = $this->get_electronic_categories();
            $_SESSION['electronic_categories'] = $categories;
        }
    }

    //static method to ensure there is just one Electronic Model instance
    public static function getElectronicModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new ElectronicModel();
        }
        return self::$_instance;
    }

    /*
     * the list_electronic method retrieves all electronics from the database and
     * returns an array of Electronic objects if successful or false if failed.
     * Electronics should also be filtered by categories and/or sorted by titles or rating if they are available.
     */

    public function list_electronic() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblElectronic . "," . $this->tblElectronicCategory .
                " WHERE " . $this->tblElectronic . ".category=" . $this->tblElectronicCategory . ".category_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no electronic was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned electronics
        $electronics = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $electronic = new \warehouse_mvc\models\Electronic(stripslashes($obj->id),stripslashes($obj->product), \stripslashes($obj->category),\stripslashes($obj->year_model), \stripslashes($obj->sku),\stripslashes($obj->model), \stripslashes($obj->price), \stripslashes($obj->image));

            //set the id for the electronic
            $electronic->setId($obj->id);

            //add the electronic into the array
            $electronics[] = $electronic;
        }
        return $electronics;
    }

    /*
     * the viewElectronic method retrieves the details of the electronic specified by its id
     * and returns a electronic object. Return false if failed.
     */

    public function view_electronic($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblElectronic . "," . $this->tblElectronicCategory .
                " WHERE " . $this->tblElectronic . ".category=" . $this->tblElectronicCategory . ".category_id" .
                " AND " . $this->tblElectronic . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a electronic object
            $electronic = new Electronic(stripslashes($obj->id),stripslashes($obj->product),stripslashes($obj->category), stripslashes($obj->year_model), stripslashes($obj->sku), stripslashes($obj->model), stripslashes($obj->price), stripslashes($obj->image));

            //set the id for the electronic
            $electronic->setId($obj->id);

            return $electronic;
        }

        return false;
    }

    //the update_electronic method updates an existing electronic in the database. Details of the electronic are posted in a form. Return true if succeed; false otherwise.
    public function update_electronic($id) {
        $id = isset($_POST['id']) && $_POST['id'] != "" ? $_POST['id'] : null;
        $product = isset($_POST['product']) && trim(($_POST['product'] != "")) ? trim($_POST['product']) : null;
        $category = isset($_POST['category']) && $_POST['category'] != "" ? $_POST['category'] : null;
        $year_model = isset($_POST['year_model']) && trim($_POST['year_model'] != "") ? trim($_POST['year_model']) : null;
        $sku = isset($_POST['sku']) && trim($_POST['sku'] != "") ? trim($_POST['sku']) : null;
        $model = isset($_POST['model']) && trim($_POST['model'] != "") ? trim($_POST['model']) : null;
        $price = isset($_POST['price']) && trim($_POST['price'] != "") ? trim($_POST['price']) : null;
        $image = isset($_POST['image']) && trim($_POST['image'] != "" )? trim($_POST['image']) : null;

        //make sure none of them is null
        if ($product && $category && $year_model && $sku && $model && $price && $image) {
            //query string for update 
            $sql = "UPDATE " . $this->tblElectronic .
                    " SET id='$id', product='$product', category='$category', year_model='$year_model', sku='$sku', model='$model',"
                    . "price='$price', image='$image' WHERE id='$id'";

            //execute the query
            return $this->dbConnection->query($sql);
        }
        return false;
    }
    
    //search the database for electronics that match words in titles. Return an array of electronics if succeed; false otherwise.
    public function search_electronic($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblElectronic . "," . $this->tblElectronicCategory .
                " WHERE " . $this->tblElectronic . ".category=" . $this->tblElectronicCategory . ".category_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND product LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no electronic was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 electronic found.
        //create an array to store all the returned electronics
        $electronics = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $electronic = new Electronic($obj->id,$obj->product, $obj->category, $obj->year_model,$obj->sku, $obj->model, $obj->price, $obj->image);

            //set the id for the electronic
            $electronic->setId($obj->id);

            //add the electronic into the array
            $electronics[] = $electronic;
        }
        return $electronics;
    }
    
    //get all electronic categories
    private function get_electronic_categories() {
        $sql = "SELECT * FROM " . $this->tblElectronicCategory;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $categories = array();
        while ($obj = $query->fetch_object()) {
            $categories[$obj->category] = $obj->category_id;
        }
        return $categories;
    }
}