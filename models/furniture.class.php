<?php

/*
 * Author: Louie Zhu
 * Date: 11/28/2014
 * Name: movie.class.php
 * Description: the Movie class models a real-world movie.
 */
namespace warehouse_mvc\models;

class Furniture {

    //private data members
    private $id, $product, $brand,$material,$category,$price ,$image;

    //the constructor
    public function __construct($id, $product, $brand, $material, $category, $price, $image) {
        $this->id = $id;
        $this->product = $product;
        $this->brand = $brand;
        $this->material = $material;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
    }
	
	//getters
    public function getId() {
        return $this->id;
    }
    
    public function getProduct() {
        return $this->product;
    }
    
    public function getBrand() {
        return $this->brand;
    }
    
     public function getMaterial() {
        return $this->material;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }

    //set furniture id
    public function setId($id) {
        $this->id = $id;
    }

}