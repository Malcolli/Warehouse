<?php
/*
 * Author: Louie Zhu
 * Date: Dec 24, 2014
 * Name: index.php
 * Description: The homepage
 */
//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("application/autoloader.class.php");

//load the displather that dissects a request URL
new \warehouse_mvc\application\Dispatcher();