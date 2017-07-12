<?php
/*
 * Author:
 * Date: 
 * File: book_controller.class.php
 * Description:
 *
 */

namespace warehouse_mvc\controllers;

//namesapce alias
use \warehouse_mvc\views\furniture as furniture;

class FurnitureController {

    private $furniture_model;

    //default constructor
    public function __construct() {
        //create an instance of the FurnitureModel class
        $this->furniture_model = \warehouse_mvc\models\FurnitureModel::getFurnitureModel();
    }

    //index action that displays all furnitures
    public function index() {
        //retrieve all furnitures and store them in an array
        $furnitures = $this->furniture_model->list_furniture();

        if (!$furnitures) {
            //display an error
            $message = "There was a problem displaying furnitures.";
            $this->error($message);
            return;
        }

        // display all furnitures
        $view = new furniture\index\Index();
        $view->display($furnitures);
    }

    //show details of a piece of furniture
    public function detail($id) {
        //retrieve the specific furniture
        $furniture = $this->furniture_model->view_furniture($id);

        if (!$furniture) {
            //display an error
            $message = "There was a problem displaying the furniture id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display furniture details
        $view = new furniture\detail\Detail();
        $view->display($furniture);
    }
    
        //display a furniture in a form for editing
    public function edit($id) {
        //retrieve the specific furniture
        $furniture = $this->furniture_model->view_furniture($id);

        if (!$furniture) {
            //display an error
            $message = "There was a problem displaying the furniture id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new furniture\edit\Edit();
        $view->display($furniture);
    }

    //update a furniture in the database
    public function update($id) {
        //update the furniture
        $update = $this->furniture_model->update_furniture($id);
        if (!$update) {
            //handle errors
            $message = "Ooops!! Something went wrong updating the furniture id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed furniture details
        $confirm = "The furnitures was successfully updated.";
        $furniture = $this->furniture_model->view_furniture($id);

        $view = new furniture\detail\Detail();
        $view->display($furniture, $confirm);
    }

    //search furnitures
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all furnitures
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching furnitures
        $furnitures = $this->furniture_model->search_furniture($query_terms);

        if ($furnitures === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched furnitures
        $search = new furniture\search\Search();
        $search->display($query_terms, $furnitures);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $furnitures = $this->furniture_model->search_furniture($query_terms);

        // Set the XML header
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

        // construct an XML document for all furnitures returned
        $output = '<products>';

        // loop through the furnitures array and add them to the output
        if ($furnitures) {
            foreach ($furnitures as $furniture) {
                $output .= '<product>' . $furniture->getProduct() . '</product>';
                //$output .= '<product>' . $furniture->getBrand() . '</product>';
            }
        }
        $output .= '</products>';  //close the root node
        echo $output;
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new furniture\error\Error();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

}