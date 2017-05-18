<?php
session_start();
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$bookObj = new Book($dbObj); // Create an object of Book class
$errorArr = array(); //Array of errors


//fetch all books
header('Content-type: application/json');
echo $bookObj->fetch();