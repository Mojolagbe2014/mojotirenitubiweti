<?php
session_start();
if(isset($_POST['submit'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) :  ''; 
    if($email == "") {array_push ($errorArr, "valid email ");}
    $name = filter_input(INPUT_POST, 'fname') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'fname')) :  ''; 
    if($name == "") {array_push ($errorArr, " name ");}
    $address = filter_input(INPUT_POST, 'address') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'address')) :  ''; 
    if($address == "") {array_push ($errorArr, " address ");}
    $state = filter_input(INPUT_POST, 'state') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'state')) :  ''; 
    if($state == "") {array_push ($errorArr, " state/province ");}
    $postCode = filter_input(INPUT_POST, 'post') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'post')) :  ''; 
    if($postCode == "") {array_push ($errorArr, " postal code ");}
    $country = filter_input(INPUT_POST, 'country') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'country')) :  ''; 
    if($country == "") {array_push ($errorArr, " country ");}
    $telephone = filter_input(INPUT_POST, 'telephone') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'telephone')) :  ''; 
    if($telephone == "") {array_push ($errorArr, " telephone ");}
    $body = filter_input(INPUT_POST, 'message') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'message')) :  ''; 
    if($body == "") {array_push ($errorArr, " message ");}
    $subject = filter_input(INPUT_POST, 'subject') ? mysqli_real_escape_string($dbObj->connection, filter_input(INPUT_POST, 'subject')) :  ''; 

    $captcha = trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha'] ? "" : 1;
    if($captcha == "") {array_push ($errorArr, " captcha ");}
    
    
    if(count($errorArr) < 1)   {
        $emailAddress = COMPANY_EMAIL;//iadet910@iadet.net
        if(empty($subject)) $subject = "Message From: $name";	
        $transport = Swift_MailTransport::newInstance();
        $message = Swift_Message::newInstance();
        
            $content = "<table>";
            $content .= "<tr>";
            $content .= "<th>Full Name</th><th>Address</th> <th>State</th><th>Post Code</th><th>Country</th><th>Telephone</th><th>Email</th><th>Message</th>";
            $content .= "</tr>";
            $content .= "<tr>";
            $content .= "<td>" . $name . "</td><td>" . $address . "</td> <td>" . $state . "</td><td>" . $postCode . "</td><td>" . $country . "</td><td>" . $telephone . "</td><td>" . $email. "</td><td>" . $body . "</td>";
            $content .= "</tr>";
            $content .= "</table>";
            $content .= "</body>";
            $content .= "</html>";
        
        $message->setTo(array($emailAddress => WEBSITE_AUTHOR));
        $message->setSubject($subject);
        $message->setBody($content);
        $message->setFrom($email, $name);
        $message->setContentType("text/html");
        $mailer = Swift_Mailer::newInstance($transport);
        $mailer->send($message);
        $msgStatus = 'success';
        $msg = $thisPage->messageBox('Your message has been sent.', 'success');
    }else{ $msgStatus = 'error'; $msg = $thisPage->showError($errorArr); }
    
    $_SESSION['msgStatus'] = $msgStatus;
    $_SESSION['msg'] = $msg;
    $thisPage->redirectTo(SITE_URL);
}

?>