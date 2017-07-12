<?php
/*
 * Author:
 * Date: 
 * File: electronic_controller.class.php
 * Description:
 *
 */

namespace warehouse_mvc\controllers;

//namesapce alias
use \warehouse_mvc\views\electronic as electronic;

class ElectronicController {

    private $electronic_model;

    //default constructor
    public function __construct() {
        //create an instance of the ElectronicModel class
        $this->electronic_model = \warehouse_mvc\models\ElectronicModel::getElectronicModel();
    }

    //index action that displays all electronics
    public function index() {
        //retrieve all electronics and store them in an array
        $electronics = $this->electronic_model->list_electronic();

        if (!$electronics) {
            //display an error
            $message = "There was a problem displaying electronics.";
            $this->error($message);
            return;
        }

        // display all electronics
        $view = new electronic\index\Index();
        $view->display($electronics);
    }

    //show details of a electronic
    public function detail($id) {
        //retrieve the specific electronic
        $electronic = $this->electronic_model->view_electronic($id);

        if (!$electronic) {
            //display an error
            $message = "There was a problem displaying the electronic id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display electronic details
        $view = new electronic\detail\Detail();
        $view->display($electronic);
    }
    
        //display a electronic in a form for editing
    public function edit($id) {
        //retrieve the specific electronic
        $electronic = $this->electronic_model->view_electronic($id);

        if (!$electronic) {
            //display an error
            $message = "There was a problem displaying the electronic id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new electronic\edit\Edit();
        $view->display($electronic);
    }

    //update a electronic in the database
    public function update($id) {
        //update the electronic
        $update = $this->electronic_model->update_electronic($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the electronic id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed electronic details
        $confirm = "The electronics was successfully updated.";
        $electronic = $this->electronic_model->view_electronic($id);

        $view = new electronic\detail\Detail();
        $view->display($electronic, $confirm);
    }

    //search electronics
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all electronics
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching electronics
        $electronics = $this->electronic_model->search_electronic($query_terms);

        if ($electronics === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched electronics
        $search = new electronic\search\Search();
        $search->display($query_terms, $electronics);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $electronics = $this->electronic_model->search_electronic($query_terms);

        // Set the XML header
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

        // construct an XML document for all electronics returned
        $output = '<product>';

        // loop through the electronics array and add them to the output
        if ($electronics) {
            foreach ($electronics as $electronic) {
                $output .= '<product>' . $electronic->getProduct() . '</product>';
            }
        }
        $output .= '</product>';  //close the root node
        echo $output;
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new electronic\error\Error();

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