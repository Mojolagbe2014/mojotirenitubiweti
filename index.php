<?php 
session_start();
define("CONST_FILE_PATH", "includes/constants.php");
define("CURRENT_PAGE", "home");
require('classes/WebPage.php'); //Set up page as a web page
require 'swiftmailer/lib/swift_required.php';
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$thisPage->dbObj = $dbObj;
$programObj = new News($dbObj);
$sliderObj = new Slider($dbObj);
$testimonialObj = new Testimonial($dbObj);
$brochureObj = new CourseBrochure($dbObj);
$videoObj = new Video($dbObj);
$settingObj = new Setting($dbObj);
$Obj = new Setting($dbObj);
$userObj = new User($dbObj); // Create an object of Admin class
$errorArr = array(); //Array of errors
$msg = ''; $msgStatus = '';

include('includes/other-settings.php');
require('includes/page-properties.php');
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
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <?php include('includes/meta-tags.php'); ?>

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <link rel="stylesheet" href="assets/css/slick/slick.css"> 
        <link rel="stylesheet" href="assets/css/slick/slick-theme.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/iconfont.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/bootsnav.css">

        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link href="<?php echo SITE_URL; ?>sweet-alert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo SITE_URL; ?>sweet-alert/twitter.css" rel="stylesheet" type="text/css"/>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">
        <?php include('includes/preloader.php'); ?>

        <div class="culmn">
            
            <?php include('includes/header.php'); ?>

            <?php include('includes/slider.php'); ?>
            
            <?php include('includes/welcome.php'); ?>

            <?php include('includes/program-intro.php'); ?>

            <?php include('includes/the-program.php'); ?>

            <!--Testimonial section-->
            <section id="test" class="test bg-grey roomy-60 fix">
                <div class="container">
                    <div class="row">                        
                        <div class="main_test fix">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="head_title text-center fix">
                                    <h2 class="text-uppercase">Testimonials</h2>
                                    <h5>What our clients say...</h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="assets/images/test-img1.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="test_item fix sm-m-top-30">
                                    <div class="item_img">
                                        <img class="img-circle" src="assets/images/test-img2.jpg" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5>Sarah Smith</h5>
                                        <h6>envato.com</h6>

                                        <p>Natus voluptatum enim quod necessitatibus quis
                                            expedita harum provident eos obcaecati id culpa
                                            corporis molestias.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End of Testimonial section -->

            <?php include('includes/register.php'); ?>

            <!--Call to  action section-->
            <section id="action" class="action bg-primary roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="maine_action">
                            <div class="col-md-8">
                                <div class="action_item text-center">
                                    <h2 class="text-white text-uppercase">I am interested in attending a seminar</h2>
                                </div>
                            </div>
                            <div class="col-md-4 inner-link">
                                <div class="action_btn text-left sm-text-center">
                                    <a href="#register" class="btn btn-default">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include('includes/footer.php'); ?>
        </div>

        <!-- JS includes -->
        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/jquery.easing.1.3.js"></script>
        <script src="assets/css/slick/slick.js"></script>
        <script src="assets/css/slick/slick.min.js"></script>
        <script src="assets/js/jquery.collapse.js"></script>
        <script src="assets/js/bootsnav.js"></script>

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="<?php echo SITE_URL; ?>sweet-alert/sweetalert.min.js" type="text/javascript"></script>
        <?php if(isset($_SESSION['msg'])) {  ?>
        <script>
            swal({
                title: "Message Box!",
                text: '<?php echo $_SESSION['msg']; ?>',
                confirmButtonText: "Okay",
                customClass: 'twitter',
                html: true,
                type: '<?php echo $_SESSION['msgStatus']; ?>'
            });
        </script>
        <?php  unset($_SESSION['msg']); unset($_SESSION['msgStatus']);  } ?>
        <?php if(!empty($msg)) { $swalTitle = ($msgStatus == 'success') ?  'Message Sent!': 'Message Not Sent!';    ?>
        <script>
            swal({
                title: '<?php echo $swalTitle; ?>',
                text: '<?php echo $msg; ?>',
                confirmButtonText: "Okay",
                customClass: 'facebook',
                html: true,
                type: '<?php echo $msgStatus; ?>'
            });
        </script>
        <?php  $msg =''; $msgStatus ='';  } ?>
    </body>
</html>
