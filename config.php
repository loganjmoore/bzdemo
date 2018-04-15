<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 9:28 AM
 */

$dbhost="db733848912.db.1and1.com";
$dbuser="dbo733848912";
$dbpass="Breeze123!";
$dbname="db733848912";

$db = new PDO("mysql:host=$dbhost;dbname=".$dbname, $dbuser, $dbpass);

//required libraries
require_once 'vendor/autoload.php';
require_once 'dbhelper.php';
require_once 'validator.php';