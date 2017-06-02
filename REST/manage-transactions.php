<?php
session_start();
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
require '../swiftmailer/lib/swift_required.php';
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database

$transactionObj = new Transaction($dbObj); // Create an object of PurchaseRecord class
$errorArr = array(); //Array of errors
include('../includes/other-settings.php');

if(!isset($_SESSION['ITCLoggedInAdmin']) || !isset($_SESSION["ITCadminEmail"])){ 
    $json = array("status" => 0, "msg" => "You are not logged in."); 
    header('Content-type: application/json');
    echo json_encode($json);
}
else{
    if(filter_input(INPUT_POST, "fetchTransactions") != NULL){
        $requestData= $_REQUEST;

        $columns = array(0 => 'id', 1 => 'id', 2 => 'transaction_id', 3 =>  'book', 4 =>  'units', 5 =>'amount', 
            6 => 'category', 7 =>  'date_purchased', 8 =>  'buyer_name', 9 => 'buyer_email', 10 => 'buyer_phone',
            11 => 'buyer_address', 12 => 'card_holder', 13 => 'card_number', 14 => 'expiry_date', 15 => 'card_cvc');

        // getting total number records without any search
        $query = $dbObj->query("SELECT * FROM transaction ");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

        $sql = "SELECT * FROM transaction WHERE 1=1 "; //id, name, short_name, category, start_date, code, description, media, amount, date_registered
        if(!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                $sql.=" AND ( transaction_id LIKE '%".$requestData['search']['value']."%' ";    
                $sql.=" OR date_purchased LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR amount LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR units LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR buyer_name LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR buyer_email LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR buyer_phone LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR card_holder LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR card_number LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR expiry_date LIKE '%".$requestData['search']['value']."%' ";
                $sql.=" OR card_cvc LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $query = $dbObj->query($sql);
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

        echo $transactionObj->fetchForJQDT($requestData['draw'], $totalData, $totalFiltered, $sql);
    }
    
    if(filter_input(INPUT_POST, "deleteThisTransaction")!=NULL){
        $postVars = array('id'); // Form fields names
        $bookMedia = "";
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                default     :   $transactionObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                                if($transactionObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            $keyToValue = array('card_holder' => '', 'card_cvc' => '', 'expiry_date' => '', 'card_number' => '');
            echo Transaction::updateMultiple($dbObj, $keyToValue, $transactionObj->id);
        }
        else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }

    } 
    
    if(filter_input(INPUT_GET, "activeTransaction")!=NULL){
        $postVars = array('id', 'status'); // Form fields names
        //Validate the POST variables and add up to error message if empty
        foreach ($postVars as $postVar){
            switch($postVar){
                case 'status':  $transactionObj->$postVar = filter_input(INPUT_GET, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_GET, $postVar, FILTER_VALIDATE_INT)) :  0; 
                                $transactionObj->$postVar = 1;
                                break;
                default     :   $transactionObj->$postVar = filter_input(INPUT_GET, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_GET, $postVar)) :  ''; 
                                if($transactionObj->$postVar === "") {array_push ($errorArr, "Please enter $postVar ");}
                                break;
            }
        }
        //If validated and not empty submit it to database
        if(count($errorArr) < 1)   {
            $transactionObj->book = Transaction::getSingle($dbObj, 'book', $transactionObj->id);
            $transactionObj->transactionId = Transaction::getSingle($dbObj, 'transaction_id', $transactionObj->id);
            $transactionObj->datePurchased = Transaction::getSingle($dbObj, 'date_purchased', $transactionObj->id);
            $transactionObj->currency = Transaction::getSingle($dbObj, 'currency', $transactionObj->id);
            $transactionObj->amount = Transaction::getSingle($dbObj, 'amount', $transactionObj->id);
            $transactionObj->units = Transaction::getSingle($dbObj, 'units', $transactionObj->id);
            $transactionObj->buyerName = Transaction::getSingle($dbObj, 'buyer_name', $transactionObj->id);
            $transactionObj->buyerEmail = Transaction::getSingle($dbObj, 'buyer_email', $transactionObj->id);
            $transactionObj->buyerPhone = Transaction::getSingle($dbObj, 'buyer_phone', $transactionObj->id);
            
            $targetBook = MEDIA_FILES_PATH."book/". Book::getSingle($dbObj, 'media', $transactionObj->book);
            $bookNewName = StringManipulator::slugify(StringManipulator::trimStringToFullWord(160, Book::getName($dbObj, $transactionObj->book))).".".pathinfo($targetBook,PATHINFO_EXTENSION);
            
            $emailAddress = COMPANY_EMAIL;
            $transport = Swift_MailTransport::newInstance();
            $message = Swift_Message::newInstance();
            $subject = "Book Purchase Transaction Response - ".WEBSITE_AUTHOR;
            $content = "Dear ".$transactionObj->buyerName.", <br/> <p>You have successfully purchased [".Book::getName($dbObj, $transactionObj->book). ' eBook]. <br/>Kindly download the attached ebook. <br/>Thanks<p>'.
                        '
                        <div align="center"><h2>Payment Success</h2></div>
                        <table border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;font-size: 13px;font-family: Arial, sans-serif;">
                        <thead style="background: #BCE4FA;font-weight: bold;">
                        <tr>
                        <th style="border-bottom: 1px solid #ddd;">Transaction ID</th>
                        <th style="border-bottom: 1px solid #ddd;">Date</th>
                        <th style="border-bottom: 1px solid #ddd;">Currency</th>
                        <th style="border-bottom: 1px solid #ddd;">Amount</th>
                        <th style="border-bottom: 1px solid #ddd;">Book</th>
                        <th style="border-bottom: 1px solid #ddd;">Units</th>
                        <th style="border-bottom: 1px solid #ddd;">Buyer Name</th>
                        <th style="border-bottom: 1px solid #ddd;">Buyer Email</th>
                        <th style="border-bottom: 1px solid #ddd;">Buyer Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>'.$transactionObj->transactionId.'</td>
                        <td>'.$transactionObj->datePurchased.'</td>
                        <td>'.$transactionObj->currency.'</td>
                        <td>'.number_format($transactionObj->amount).'</td>
                        <td>'.Book::getName($dbObj, $transactionObj->book).'</td>
                        <td>'.$transactionObj->units.'</td>
                        <td>'.$transactionObj->buyerName.'</td>
                        <td>'.$transactionObj->buyerEmail.'</td>
                        <td>'.$transactionObj->buyerPhone.'</td></tr><tr>
                        <td colspan="6">
                        <div align="center">
                        <a href="'.SITE_URL.'">Buy more books now!</a></div></td></tr></tbody></table>'
                    . "<br/> For any enquiries contact us via <a href='mailto:$emailAddress'>$emailAddress</a>";
            $message->setTo(array($transactionObj->buyerEmail => $transactionObj->buyerName));
            $message->setSubject($subject);
            $message->setBody($content);
            $message->setFrom($emailAddress, WEBSITE_AUTHOR);
            $message->setContentType("text/html");
            $mailer = Swift_Mailer::newInstance($transport);
            $message->attach( 
                Swift_Attachment::fromPath($targetBook)->setFilename($bookNewName)
            );
            $mailer->send($message);
            //echo Transaction::updateSingle($dbObj, ' status ',  $transactionObj->status, $transactionObj->id); 
//            $json = array("status" => 0, "msg" => $content); 
//            $dbObj->close();//Close Database Connection
//            header('Content-type: application/json');
//            echo json_encode($json);
            
        }
        else{ 
            $json = array("status" => 0, "msg" => $errorArr); 
            $dbObj->close();//Close Database Connection
            header('Content-type: application/json');
            echo json_encode($json);
        }

    }
}