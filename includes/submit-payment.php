<?php
session_start();
if(isset($_POST['submitPayment'])){
    $postVars = array('book','units','amount','currency','cardHolder','cardNumber', 'expiryDate', 'cardCVC', 'buyerName', 'buyerEmail', 'buyerPhone', 'buyerAddress'); // Form fields names
    //Validate the POST variables and add up to error message if empty
    foreach ($postVars as $postVar){
        switch($postVar){
            case 'buyerEmail':   $transactionObj->$postVar = filter_input(INPUT_POST, $postVar, FILTER_VALIDATE_EMAIL) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar, FILTER_VALIDATE_EMAIL)) :  ''; 
                            if($transactionObj->$postVar === "") {array_push ($errorArr, " valid $postVar ");}
                            break;
            default     :   $transactionObj->$postVar = filter_input(INPUT_POST, $postVar) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, $postVar)) :  ''; 
                            if($transactionObj->$postVar == "") {array_push ($errorArr, "Please enter $postVar ");}
                            break;
        }
    }
    
    
    if(count($errorArr) < 1)   {
        $transactionObj->transactionId = "PAY".rand(111111111111, 999999999999);
        $transactionObj->amount = Book::getSingle($dbObj, 'amount', $transactionObj->book);
        $response = $transactionObj->addRaw();
        $msgStatus = $response["value"];
        
        if($response['status'] == 1) {
            $emailAddress = COMPANY_EMAIL;
            $subject = "Payment Details for ".Book::getName($dbObj, $transactionObj->book)." Received -  ".WEBSITE_AUTHOR;
            $transport = Swift_MailTransport::newInstance();
            $message = Swift_Message::newInstance();

            $content = "<strong>From:</strong>".WEBSITE_AUTHOR." <br/><br/> <strong>Message:</strong> Your payment details for [".Book::getName($dbObj, $transactionObj->book). ' eBook] has been received. <em>We will send you another email containing the book as an attachment once the payment is verified.</em>'.
                            '. 
                            <style type="text/css">
                            .transaction_info {margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;font-size: 13px;font-family: Arial, sans-serif;}
                            .transaction_info thead {background: #BCE4FA;font-weight: bold;}
                            .transaction_info thead tr th {border-bottom: 1px solid #ddd;}
                            </style>
                            <div align="center"><h2>Payment Details</h2></div>
                            <table border="0" cellpadding="10" cellspacing="0" class="transaction_info">
                            <thead><tr>
                            <td>Transaction ID</td>
                            <td>Currency</td>
                            <td>Amount</td><td>Book</td>
                            <td>Units</td><td>Buyer Name</td>
                            <td>Buyer Email</td><td>Buyer Phone</td></tr></thead>
                            <tbody>
                            <tr>
                            <td>'.$transactionObj->transactionId.'</td>
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
                        . "<br/> For any enquiries contact us via <a href='mailto:$emailAddress'>$emailAddress</a> or <a href='phone:".COMPANY_HOTLINE."'>".COMPANY_HOTLINE."</a>";

            $message->setTo(array($transactionObj->buyerEmail => $transactionObj->buyerName));
            $message->setSubject($subject);
            $message->setBody($content);
            $message->setFrom($emailAddress, WEBSITE_AUTHOR);
            $message->setContentType("text/html");
            $mailer = Swift_Mailer::newInstance($transport);
            $mailer->send($message);

            //copy message to the admin
            $transport1 = Swift_MailTransport::newInstance();
            $subject1 = "New Payment Made for ".Book::getName($dbObj, $transactionObj->book)." -  ".WEBSITE_AUTHOR;
            $message1 = Swift_Message::newInstance();  
            $content1 = "<h2>New payment has been made.</h2> <p>Login to the <a href='".SITE_URL."operator'>admin</a> of the website now to confirm the details!</p>";
            $message1->setTo(array($emailAddress => WEBSITE_AUTHOR, COMPANY_OTHER_EMAILS => WEBSITE_AUTHOR));
            $message1->setSubject($subject1);
            $message1->setBody($content1);
            $message1->setFrom("noreply@train2bwealthy.com", "Auto Generated Message");
            $message1->setContentType("text/html");
            $mailer1 = Swift_Mailer::newInstance($transport1);
            $mailer1->send($message1);

            $msg = $thisPage->messageBox('<p>Your payment details has been sent.<br/> <strong>Please check your email address for confirmation message.</strong> <br/> Thanks</p>', 'success');
        }
        else{ $msg = $thisPage->showError($response["msg"]); }
    }else{ $msgStatus = 'error'; $msg = $thisPage->showError($errorArr); }
    
    $_SESSION['msgStatus'] = $msgStatus;
    $_SESSION['msg'] = $msg;
    $thisPage->redirectTo(SITE_URL);
}