<?php
session_start();
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$courseObj = new Course($dbObj); // Create an object of Course class
$errorArr = array(); //Array of errors
$courseMedFil =""; $courseImgFil ="";
if(!isset($_SESSION['ITCLoggedInAdmin']) || !isset($_SESSION["ITCadminEmail"])){ 
    $json = array("status" => 0, "msg" => "You are not logged in."); 
    echo json_encode($json);
}
else{
    if(filter_input(INPUT_POST, "addNewCourse") != NULL){
        $postVars = array('name','image','category','description','media','amount', 'currency'); // Form fields names
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                case 'image':   $courseObj->$postVar = basename($_FILES["image"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", filter_input(INPUT_POST, '0'))).".".pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION): ""; 
                                $courseImgFil = $courseObj->$postVar;
                                if($courseObj->$postVar == "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                case 'media':   $courseObj->$postVar = basename($_FILES["file"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", filter_input(INPUT_POST, '0'))).".".pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION): ""; 
                                $courseMedFil = $courseObj->$postVar;
                                if($courseObj->$postVar == "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
                default     :   $courseObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                if($courseObj->$postVar == "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            $targetFile = MEDIA_FILES_PATH."book/". $courseMedFil;
            $targetImage = MEDIA_FILES_PATH."book-image/". $courseImgFil;
            $uploadOk = 1; $msg = ''; //$normalSize = true; $isImage = true;
            $docFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
            
            if (file_exists($targetImage) && $courseImgFil!="") { $msg .= " Course image already exists."; $uploadOk = 0; }
            //if ($_FILES["file"]["size"] > 800000000 || $_FILES["image"]["size"] > 8000000) { $msg .= " Course media is too large."; $normalSize = false; }
            if ($docFileType!='doc' && $docFileType!='docx' && $docFileType!='pdf' && $docFileType!='xls' && $docFileType!='csv') { 
                $msg .= "Book must be in either of these formats: PDF, DOC, DOCX, XLS, CSV."; $uploadOk = 0; 
            }
            if($uploadOk == 1 && Imaging::checkDimension($_FILES["image"]["tmp_name"], 400, 400, 'equ', 'both')== 'true'){ 
                if($courseMedFil !=''){ move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);}
                if($courseImgFil !=''){ move_uploaded_file($_FILES["image"]["tmp_name"], $targetImage);}
                echo $courseObj->add(); 
            }
            else {
                $msg = "Sorry, your book was not uploaded. ERROR: ".$msg.Imaging::checkDimension($_FILES["image"]["tmp_name"], 400, 400, 'equ', 'both');
                $json = array("status" => 0, "msg" => $msg); 
                $dbObj->close();//Close Database Connection
                header('Content-type: application/json');
                echo json_encode($json);
            } 

        }else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }
    } 
}