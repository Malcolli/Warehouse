<?php

/*
 * Author: Louie Zhu
 * Date: Jan 1, 2015
 * Name: electronic.class.php
 * Description: the Electronic class models a real-world electronic.
 */
namespace warehouse_mvc\models;

class Electronic {
    
    //private properties of a Electronic object
    private $id, $product, $category, $year_model, $sku, $model, $price, $image;
    
    //the constructor that initializes all properties
    public function __construct($id, $product, $category, $year_model, $sku, $model, $price, $image) {
        $this->id = $id;
        $this->product = $product;
        $this->category = $category;
        $this->year_model = $year_model;
        $this->sku = $sku;
        $this->model = $model;
        $this->price = $price;
        $this->image = $image;
    }
    /////////////////////************************CONTINUE HERE*********************************
    //get the id of a electronic
    public function getId() {
        return $this->id;
        
    }
    	//get the title of a electronic
    public function getProduct() {
        return $this->product;
    }
    
		//get the Category of a electronic
    public function getCategory() {
        return $this->category;
    }
    
	//get the category of a electronic
    public function getYearModel() {
        return $this->year_model;
    }

	//get the publish date of a electronic
    public function getSKU() {
        return $this->sku;
    }

	//get the publisher of a electronic
    public function getModel() {
        return $this->model;
    }

	//get the image file name of a electronic
    public function getPrice() {
        return $this->price;
    }

	//get the description of a electronic
    public function getImage() {
        return $this->image;
    }

    
    //set electronic id
    public function setId($id) {
        $this->id = $id;
    }
}
