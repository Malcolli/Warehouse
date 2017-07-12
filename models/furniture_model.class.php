<?php

/*
 * Author: Louie Zhu
 * Date: Oct 26, 2014
 * File: furniture_model.class.php
 * Description: the furniture model
 * 
 */

namespace warehouse_mvc\models;

class FurnitureModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblFurniture;
    private $tblFurnitureCategory;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getFurnitureModel method must be called.
    private function __construct() {
        session_start();
        $this->db = \warehouse_mvc\application\Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblFurniture = $this->db->getFurnitureTable();
        $this->tblFurnitureCategory = $this->db->getFurnitureCategoryTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        
        //initialize Furniture category
        if (!isset($_SESSION['furniture_categories'])) {
            $categories = $this->get_furniture_categories();
            $_SESSION['furniture_categories'] = $categories;
        }
    }

    //static method to ensure there is just one FurnitureModel instance
    public static function getFurnitureModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new FurnitureModel();
        }
        return self::$_instance;
    }

    /*
     * the list_furniture method retrieves all furnitures from the database and
     * returns an array of Furniture objects if successful or false if failed.
     * Furnitures should also be filtered by categories and/or sorted by titles or rating if they are available.
     */

    public function list_furniture() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblFurniture . "," . $this->tblFurnitureCategory .
                " WHERE " . $this->tblFurniture . ".category=" . $this->tblFurnitureCategory . ".category_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no furniture was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned furnitures
        $furnitures = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $furniture = new \warehouse_mvc\models\Furniture(\stripslashes($obj->id),\stripslashes($obj->product),\stripslashes($obj->brand), \stripslashes($obj->material),\stripslashes($obj->category),\stripslashes($obj->price), \stripslashes($obj->image));

            //set the id for the furniture
            $furniture->setId($obj->id);

            //add the furniture into the array
            $furnitures[] = $furniture;
        }
        return $furnitures;
    }

    /*
     * the viewFurniture method retrieves the details of the furniture specified by its id
     * and returns a furniture object. Return false if failed.
     */

    public function view_furniture($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblFurniture . "," . $this->tblFurnitureCategory .
                " WHERE " . $this->tblFurniture . ".category=" . $this->tblFurnitureCategory . ".category_id" .
                " AND " . $this->tblFurniture . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a furniture object
            $furniture = new Furniture(stripslashes($obj->id),stripslashes($obj->product), stripslashes($obj->brand), stripslashes($obj->material), stripslashes($obj->category), stripslashes($obj->price), stripslashes($obj->image));

            //set the id for the furniture
            $furniture->setId($obj->id);

            return $furniture;
        }

        return false;
    }

    //the update_furniture method updates an existing furniture in the database. Details of the furniture are posted in a form. Return true if succeed; false otherwise.
    public function update_furniture($id) {
        $id = isset($_POST['id']) && $_POST['id'] != "" ? $_POST['id'] : null;
        $product = isset($_POST['product']) && trim(($_POST['product'] != "")) ? trim($_POST['product']) : null;
        $brand = isset($_POST['brand']) && $_POST['brand'] != "" ? $_POST['brand'] : null;
        $material = isset($_POST['material']) && trim($_POST['material'] != "") ? trim($_POST['material']) : null;
        $category = isset($_POST['category']) && $_POST['category'] != "" ? $_POST['category'] : null;
        $price = isset($_POST['price']) && trim($_POST['price'] != "") ? trim($_POST['price']) : null;
        $image = isset($_POST['image']) && trim($_POST['image'] != "") ? trim($_POST['image']) : null;

        //make sure none of them are null
        if ($product && $brand  && $material &&  $category && $price && $image) {
            //query string for update 
            $sql = "UPDATE " . $this->tblFurniture .
                    " SET id='$id', product='$product', brand='$brand', material='$material', category='$category', price='$price',"
                    . "image='$image' WHERE id='$id'";
            
            //execute the query
            return $this->dbConnection->query($sql);
        }
        return false;
    }
    
    //search the database for furnitures that match words in products. Return an array of furnitures if succeed; false otherwise.
    public function search_furniture($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblFurniture . "," . $this->tblFurnitureCategory .
                " WHERE " . $this->tblFurniture . ".category=" . $this->tblFurnitureCategory . ".category_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND product LIKE '%" . $term . "%'" ;
            $sql .= " OR brand LIKE '%" . $term . "%'" ;
          
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no furniture was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 furniture found.
        //create an array to store all the returned furnitures
        $furnitures = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $furniture = new Furniture($obj->id,$obj->product,$obj->brand, $obj->material, $obj->category, $obj->price, $obj->image);

            //set the id for the furniture
            $furniture->setId($obj->id);

            //add the furniture into the array
            $furnitures[] = $furniture;
        }
        return $furnitures;
    }
    
    //get all furniture categories
    private function get_furniture_categories() {
        $sql = "SELECT * FROM " . $this->tblFurnitureCategory;

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
