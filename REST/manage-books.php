<?php
session_start();
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$bookObj = new Book($dbObj); // Create an object of BookCategory class
$errorArr = array(); //Array of errors
$oldMedia = ""; $newMedia =""; $oldImage=""; $newImage =""; $bookImageFil="";

if(!isset($_SESSION['ITCLoggedInAdmin']) || !isset($_SESSION["ITCadminEmail"])){ 
    $json = array("status" => 0, "msg" => "You are not logged in."); 
    echo json_encode($json);
}
else{
    if(filter_input(INPUT_POST, "fetchBooks") != NULL){
        $requestData= $_REQUEST;
        $columns = array( 0 =>'id', 1 =>'id', 2 =>'id', 3 => 'name', 4 => 'category', 5 => 'description', 6 => 'media', 7 => 'amount', 8 => 'message', 9 => 'image', 10 => 'date_registered');

        // getting total number records without any search
        $query = $dbObj->query("SELECT * FROM book ");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM book WHERE 1=1 "; //id, name, short_name, category, start_date, code, description, media, amount, date_registered
        if(!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql.=" AND ( name LIKE '%".$requestData['search']['value']."%' "; 
                $sql.=" OR description LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR media LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR date_registered LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR amount LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $query = $dbObj->query($sql);
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

        echo $bookObj->fetchForJQDT($requestData['draw'], $totalData, $totalFiltered, $sql);
    }
    
    if(filter_input(INPUT_POST, "deleteThisBook")!=NULL){
        $postVars = array('id', 'media', 'image'); // Form fields names
        $bookMedia = "";
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                case 'media':   $bookObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                $bookMedia = $bookObj->$postVar;
                                //if($bookObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                case 'image':   $bookObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                $bookImage = $bookObj->$postVar;
                                //if($bookObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                default     :   $bookObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                if($bookObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            $fileDelParam = true; $imageDelParam = true;
            if($bookMedia!='' && file_exists(MEDIA_FILES_PATH."book/".$bookMedia)){
                if(unlink(MEDIA_FILES_PATH."book/".$bookMedia)){ $fileDelParam = true;}
                else $fileDelParam = false;
            }
            if($bookImage!='' && file_exists(MEDIA_FILES_PATH."book-image/".$bookImage)){
                if(unlink(MEDIA_FILES_PATH."book-image/".$bookImage)){ $imageDelParam = true;}
                else $imageDelParam = false;
            }
            if($fileDelParam == true && $imageDelParam ==true){ echo $bookObj->delete(); }
            else{ 
                $json = array("status" => 0, "msg" => $errorArr); 
                $dbObj->close();//Close Database Connection
                header('Content-type: application/json');
                echo json_encode($json);
            }
        }
        else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }

    } 
    
    if(filter_input(INPUT_GET, "activeBook")!=NULL){
        $postVars = array('id', 'status'); // Form fields names
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                case 'status':  $bookObj->$postVar = filter_input(INPUT_GET, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_GET, $postVar, FILTER_VALIDATE_INT)) :  0; 
                                if($bookObj->$postVar == 1) {$bookObj->$postVar = 0;} 
                                elseif($bookObj->$postVar == 0) {$bookObj->$postVar = 1;}
//                                if($bookObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                default     :   $bookObj->$postVar = filter_input(INPUT_GET, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_GET, $postVar)) :  ''; 
                                if($bookObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            echo Book::updateSingle($dbObj, ' status ',  $bookObj->status, $bookObj->id); 
        }
        //Else show error messages
        else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }

    }
    
    if(filter_input(INPUT_POST, "updateThisBook") != NULL){
        $postVars = array('id','name','description', 'category','media','amount','image', 'currency', 'message'); // Form fields names
        $oldMedia = $_REQUEST['oldFile']; $oldImage = $_REQUEST['oldImage'];
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                case 'media':   $newMedia = basename($_FILES["file"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", filter_input(INPUT_POST, 'code'))).".".pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION): ""; 
                                $bookObj->$postVar = $newMedia;
                                if($bookObj->$postVar == ''){$bookObj->$postVar = $oldMedia;}
                                $bookMedFil = $newMedia;
                                break;
                case 'image':   $newImage = basename($_FILES["image"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", filter_input(INPUT_POST, 'code'))).".".pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION): ""; 
                                $bookObj->$postVar = $newImage;
                                if($bookObj->$postVar == "") { $bookObj->$postVar = $oldImage;}
                                $bookImageFil = $newImage;
                                break;
                case 'message': $bookObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                break;
                default     :   $bookObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                if($bookObj->$postVar == "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            //$target_dir = "../project-files/";
            $target_file = MEDIA_FILES_PATH."book/". $bookMedFil;
            $target_Image = MEDIA_FILES_PATH."book-image/". $bookImageFil;
            $uploadOk = 1; $msg = ''; $mediaFormatOk = 1;
            $docFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            if($newMedia !=""){
                if ($docFileType!='doc' && $docFileType!='docx' && $docFileType!='pdf' && $docFileType!='xls' && $docFileType!='csv') { 
                    $msg .= "Book must be in either of these formats: PDF, DOC, DOCX, XLS, CSV."; $uploadOk = 0; 
                    $mediaFormatOk = 0;
                }
                if ($mediaFormatOk == 1 && move_uploaded_file($_FILES["file"]["tmp_name"], MEDIA_FILES_PATH."book/".$bookMedFil)) {
                    $msg .= "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                    $status = 'ok'; if($oldMedia!='' && file_exists(MEDIA_FILES_PATH."book/".$oldMedia)) unlink(MEDIA_FILES_PATH."book/".$oldMedia);
                } else {
                    $uploadOk = 0;
                }
            }
            if($newImage !=""){
                if(Imaging::checkDimension($_FILES["image"]["tmp_name"], 400, 400, 'equ', 'both') != 'true'){$uploadOk = 0; $msg = Imaging::checkDimension($_FILES["image"]["tmp_name"], 400, 400, 'equ', 'both');}
                if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], MEDIA_FILES_PATH."book-image/".$bookImageFil)) {
                    $msg .= "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                    $status = 'ok'; if($oldImage!='' && file_exists(MEDIA_FILES_PATH."book-image/".$oldImage))unlink(MEDIA_FILES_PATH."book-image/".$oldImage);
                } else { $uploadOk = 0; }
            }
            
            if($uploadOk == 1){  echo $bookObj->update();  }
            else {
                $msg = " Sorry, there was an error uploading your book media. ERROR: ".$msg;
                $json = array("status" => 0, "msg" => $msg); 
                $dbObj->close();//Close Database Connection
                header('Content-type: application/json');
                echo json_encode($json);
            }
        }
        //Else show error messages
        else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }
    } 
    
}