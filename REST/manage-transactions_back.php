<?php
session_start();
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database

$transactionObj = new PurchaseRecord($dbObj); // Create an object of PurchaseRecord class
$errorArr = array(); //Array of errors

if(!isset($_SESSION['ITCLoggedInAdmin']) || !isset($_SESSION["ITCadminEmail"])){ 
    $json = array("status" => 0, "msg" => "You are not logged in."); 
    header('Content-type: application/json');
    echo json_encode($json);
}
else{
    if(filter_input(INPUT_POST, "fetchTransactions") != NULL){
        $requestData= $_REQUEST;
        $columns = array(0 => id, 1 => id, 2 => 'transaction_id', 3 =>  'user', 4 =>  'course', 5 =>'item_type', 6 => 'amount', 7 =>  'currency', 8 =>  'method', 9 => 'date_purchased', 10 => 'mode');

        // getting total number records without any search
        $query = $dbObj->query("SELECT * FROM purchase_record ");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM purchase_record WHERE 1=1 "; //id, name, short_name, category, start_date, code, description, media, amount, date_registered
        if(!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql.=" AND ( user LIKE '".$requestData['search']['value']."' ";    
                $sql.=" OR course LIKE '".$requestData['search']['value']."' ";
                $sql.=" OR transaction_id LIKE '".$requestData['search']['value']."%' ";
                $sql.=" OR amount LIKE '".$requestData['search']['value']."' ";
                $sql.=" OR date_purchased LIKE '".$requestData['search']['value']."' ) ";
        }
        $query = $dbObj->query($sql);
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

        echo $transactionObj->fetchForJQDT($requestData['draw'], $totalData, $totalFiltered, $sql);
    }
}