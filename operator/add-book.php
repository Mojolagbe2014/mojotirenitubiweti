<?php session_start(); ?>
<?php
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$adminObj = new Admin($dbObj); // Create an object of Admin class
$errorArr = array(); //Array of errors
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Book  - Train2bWealthy</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="../ckeditor/ckeditor.js" type="text/javascript"></script>
    <link href="assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="assets/js/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div id="wrapper">
        <?php include('includes/top-bar.php'); ?> 
        <!-- /. NAV TOP  -->
        <?php include('includes/side-bar.php'); ?> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="messageBox"></div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3> <i class="fa fa-file-text-o fa-2x"></i> New Book</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" id="CreateBook" name="CreateBook" action="../REST/add-book.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Title:</label>
                                        <div class="controls">
                                            <input type="text" id="name" name="name" placeholder="book title" class="form-control" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="category">Category:</label>
                                        <div class="controls">
                                            <select tabindex="1" name="category" id="category" data-placeholder="Select a category.." class="form-control" required="required">
                                                <option value="1">eBook</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="description">Description:</label>
                                        <div class="controls">
                                            <textarea class="span5" id="description" name="description" class="form-control" required="required"></textarea>
                                            <script>
                                                CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="image">Book Image <span class="text-danger"><em>(Recommended Size: width=400px, height=400px)</em></span>:</label>
                                        <div class="controls">
                                            <input data-title="book image" type="file" placeholder="book image" id="image" name="image" data-original-title="Book image" class="form-control" required="required">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="file">Additional Material (Mandatory for eBook):</label>
                                        <div class="controls">
                                            <input data-title="book media" type="file" placeholder="book media" id="file" name="file" data-original-title="book media" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="amount">Price:</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">
                                                <select name="currency" id="currency" required="required">
                                                    <option value=""> --- </option>
                                                </select>
                                            </span>
                                        <div class="controls">
                                            <input data-title="book amount" type="number" placeholder="book cost" id="amount" name="amount" data-original-title="book cost" class="form-control" required="required">
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="hidden" name="addNewBook" id="addNewBook" value="addNewBook"/>
                                            <button type="submit" name="addBook" id="addBook" class="btn btn-danger">Add Book</button> &nbsp; &nbsp;
                                            <button type="reset" class="btn btn-info">Reset Form</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="messageBox"></div>
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.1.11.4.js" type="text/javascript"></script>
    <script src="assets/js/common-handler.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
    <script src="assets/js/gritter/js/jquery.gritter.min.js" type="text/javascript"></script>
    <script src="assets/js/add-book.js?<?php echo time(); ?>"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>