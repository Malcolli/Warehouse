<?php

/*
 * Author: Louie Zhu
 * Date: Dec 6, 2014
 * File: config.php
 * Description: set application settings
 * 
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/i211/warehouse_final");

/*************************************************************************************
 *                       settings for movies                                         *
 ************************************************************************************/

//define default path for media images
define("FURNITURE_IMG", "www/img/furnitures/");


/*************************************************************************************
 *                       settings for books                                         *
 ************************************************************************************/

//define default path for media images
define("ELECTRONIC_IMG", "www/img/electronics/");