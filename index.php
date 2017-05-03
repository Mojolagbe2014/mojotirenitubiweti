<?php 
session_start();
define("CONST_FILE_PATH", "includes/constants.php");
define("CURRENT_PAGE", "home");
require('classes/WebPage.php'); //Set up page as a web page
require 'swiftmailer/lib/swift_required.php';
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$thisPage->dbObj = $dbObj;
$newsObj = new News($dbObj);
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
        <?php include('includes/pre-loader.php'); ?>

        <div class="culmn">
            
            <?php include('includes/header.php'); ?>

            <?php include('includes/homepage-slider.php'); ?>
            
            <!--Featured Section-->
            <section id="features" class="features">
                <div class="container">
                    <div class="row">
                        <div class="main_features fix roomy-70">
                            <div class="col-md-4">
                                <div class="features_item sm-m-top-30">
                                    <div class="f_item_icon">
                                        <i class="fa fa-thumbs-o-up"></i>
                                    </div>
                                    <div class="f_item_text">
                                        <h3>Best Quality Design</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque eleifend
                                            in sit amet mattis volutpat rhoncus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="features_item sm-m-top-30">
                                    <div class="f_item_icon">
                                        <i class="fa fa-tablet"></i>
                                    </div>
                                    <div class="f_item_text">
                                        <h3>Responsive Design</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque eleifend
                                            in sit amet mattis volutpat rhoncus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="features_item sm-m-top-30">
                                    <div class="f_item_icon">
                                        <i class="fa fa-sliders"></i>
                                    </div>
                                    <div class="f_item_text">
                                        <h3>Easy to Customize</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque eleifend
                                            in sit amet mattis volutpat rhoncus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Featured Section-->


            <!--Business Section-->
            <section id="business" class="business bg-grey roomy-70">
                <div class="container">
                    <div class="row">
                        <div class="main_business">
                            <div class="col-md-6">
                                <div class="business_slid">
                                    <div class="slid_shap bg-grey"></div>
                                    <div class="business_items text-center">
                                        <div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/about-img1.jpg" alt="" />
                                            </div>
                                        </div>

                                        <div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/about-img1.jpg" alt="" />
                                            </div>
                                        </div>

                                        <div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/about-img1.jpg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="business_item sm-m-top-50">
                                    <h2 class="text-uppercase"><strong>Made</strong> is Template For Business</h2>
                                    <ul>
                                        <li><i class="fa fa-arrow-circle-right"></i> Clean & Modern Design</li>
                                        <li><i class="fa  fa-arrow-circle-right"></i> Fully Responsive</li>
                                        <li><i class="fa  fa-arrow-circle-right"></i> Google Fonts</li>
                                    </ul>
                                    <p class="m-top-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit pellentesque eleifend in mi 
                                        sit amet mattis suspendisse ac ligula volutpat nisl rhoncus sagittis cras suscipit 
                                        lacus quis erat malesuada lobortis eiam dui magna volutpat commodo eget pretium vitae
                                        elit etiam luctus risus urna in malesuada ante convallis.</p>

                                    <div class="business_btn">
                                        <a href="https://bootstrapthemes.co" class="btn btn-default m-top-20">Read More</a>
                                        <a href="" class="btn btn-primary m-top-20">Buy Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End off Business section -->


            <!--product section-->
            <section id="product" class="product">
                <div class="container">
                    <div class="main_product roomy-80">
                        <div class="head_title text-center fix">
                            <h2 class="text-uppercase">What Client Say</h2>
                            <h5>Clean and Modern design is our best specialist</h5>
                        </div>

                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img1.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img1.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img1.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img1.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img1.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img1.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img2.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img2.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img3.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img3.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="assets/images/work-img4.jpg" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="assets/images/work-img4.jpg" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="port_caption m-top-20">
                                                        <h5>Your Work Title</h5>
                                                        <h6>- Graphic Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Product section -->



            <!--Test section-->
            <section id="test" class="test bg-grey roomy-60 fix">
                <div class="container">
                    <div class="row">                        
                        <div class="main_test fix">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="head_title text-center fix">
                                    <h2 class="text-uppercase">What Client Say</h2>
                                    <h5>Clean and Modern design is our best specialist</h5>
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
            </section><!-- End off test section -->


            <!--Brand Section-->
            <section id="brand" class="brand fix roomy-80">
                <div class="container">
                    <div class="row">
                        <div class="main_brand text-center">
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img1.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img2.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img3.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img4.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img5.png" alt="" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <img src="assets/images/cbrand-img6.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End off Brand section -->


            <!--Call to  action section-->
            <section id="action" class="action bg-primary roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="maine_action">
                            <div class="col-md-8">
                                <div class="action_item text-center">
                                    <h2 class="text-white text-uppercase">Your Promotion Text Will Be Here</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="action_btn text-left sm-text-center">
                                    <a href="" class="btn btn-default">Purchase Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <footer id="contact" class="footer action-lage bg-black p-top-80">
                <!--<div class="action-lage"></div>-->
                <div class="container">
                    <div class="row">
                        <div class="widget_area">
                            <div class="col-md-3">
                                <div class="widget_item widget_about">
                                    <h5 class="text-white">About Us</h5>
                                    <p class="m-top-20">Lorem ipsum dolor sit amet consec tetur adipiscing elit 
                                        nulla aliquet pretium nisi in cursus 
                                        maecenas nec eleifen.</p>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-location-arrow"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Location</h6>
                                            <p>
                                                123 suscipit ipsum nam auctor
                                                mauris dui, ac sollicitudin mauris,
                                                Bandung</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-phone"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Phone :</h6>
                                            <p>+1 2345 6789</p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-envelope-o"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-white">Email Address :</h6>
                                            <p>youremail@mail.com</p>
                                        </div>
                                    </div>
                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_latest sm-m-top-50">
                                    <h5 class="text-white">Latest News</h5>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="assets/images/ltst-img-1.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="assets/images/ltst-img-2.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                    <div class="widget_latst_item m-top-30">
                                        <div class="item_icon"><img src="assets/images/ltst-img-3.jpg" alt="" /></div>
                                        <div class="widget_latst_item_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                            <a href="">21<sup>th</sup> July 2016</a>
                                        </div>
                                    </div>
                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_service sm-m-top-50">
                                    <h5 class="text-white">Latest News</h5>
                                    <ul class="m-top-20">
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Web Design</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> User Interface Design</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> E- Commerce</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Web Hosting</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Themes</a></li>
                                        <li class="m-top-20"><a href=""><i class="fa fa-angle-right"></i> Support Forums</a></li>
                                    </ul>
                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->

                            <div class="col-md-3">
                                <div class="widget_item widget_newsletter sm-m-top-50">
                                    <h5 class="text-white">Subscribe to Our Newsletter</h5>
                                    <form class="form-inline m-top-30" name="subscribeForm" id="subscribeForm">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Enter you Email">
                                            <button type="submit" class="btn text-center"><i class="fa fa-arrow-right"></i></button>
                                        </div>

                                    </form>
                                    <div class="widget_brand m-top-40">
                                        <a href="" class="text-uppercase">Your Logo</a>
                                        <p>Lorem ipsum dolor sit amet consec tetur 
                                            adipiscing elit nulla aliquet pretium nisi in</p>
                                    </div>
                                    <ul class="list-inline m-top-20">
                                        <li>-  <a href=""><i class="fa fa-facebook"></i></a></li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href=""><i class="fa fa-behance"></i></a></li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a>  - </li>
                                    </ul>

                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->
                        </div>
                    </div>
                </div>
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 m-top-80">
                    <div class="col-md-12">
                        <p class="wow fadeInRight" data-wow-duration="1s">
                            Made with 
                            <i class="fa fa-heart"></i>
                            by 
                            <a target="_blank" href="https://bootstrapthemes.co">Bootstrap Themes</a> 
                            2016. All Rights Reserved
                        </p>
                    </div>
                </div>
            </footer>




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
