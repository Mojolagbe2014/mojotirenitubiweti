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
$bookObj = new Book($dbObj);
$transactionObj = new Transaction($dbObj);
$userObj = new User($dbObj); // Create an object of Admin class
$errorArr = array(); //Array of errors
$msg = ''; $msgStatus = '';

include('includes/other-settings.php');
require('includes/page-properties.php');
include('includes/submit-registration-form.php');
include('includes/submit-payment.php');

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->
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
        <link rel="stylesheet" href="assets/css/style.css?<?php echo time(); ?>">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link href="<?php echo SITE_URL; ?>sweet-alert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo SITE_URL; ?>sweet-alert/twitter.css" rel="stylesheet" type="text/css"/>
        <link href="Simple-Fast-Popup/dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="skeuocard/javascripts/vendor/cssua.min.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">
        <?php include('includes/preloader.php'); ?>

        <div class="culmn">
            
            <?php include('includes/header.php'); ?>

            <?php include('includes/slider.php'); ?>
            
            <?php include('includes/welcome.php'); ?>

            <?php include('includes/program-intro.php'); ?>

            <?php include('includes/the-program.php'); ?>

            <?php include('includes/store.php'); ?>
            
            <?php //include('includes/testimonials.php'); ?>

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
        
        <?php include('includes/pay-now-popup.php'); ?>

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
        <script src="Simple-Fast-Popup/dist/jquery.simple-popup.min.js" type="text/javascript"></script>
        <script src="assets/js/main.js?<?php echo time(); ?>"></script>
        <script src="<?php echo SITE_URL; ?>sweet-alert/sweetalert.min.js" type="text/javascript"></script>
        <?php if(isset($_SESSION['msg'])) {  
            $msgSt = $_SESSION['msgStatus'];
            $msg_ = $_SESSION['msg'];;
            $swalTitle = ($msgSt == 'success') ?  'Message Sent!': 'Message Not Sent!';
        ?>
        <script>
            swal({
                title: '<?php echo $swalTitle; ?>',
                text: '<?php echo $msg_; ?>',
                confirmButtonText: "Okay",
                customClass: 'twitter',
                html: true,
                type: '<?php echo $msgSt; ?>'
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
