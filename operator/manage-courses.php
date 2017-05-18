<?php session_start(); ?>
<?php
define("CONST_FILE_PATH", "../includes/constants.php");
include ('../classes/WebPage.php'); //Set up page as a web page
$thisPage = new WebPage(); //Create new instance of webPage class

$dbObj = new Database();//Instantiate database
$adminObj = new Admin($dbObj); // Create an object of Admin class
$errorArr = array(); //Array of errors
?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Books  - Train2bWealthy</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="images/icons/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="../ckeditor/ckeditor.js" type="text/javascript"></script>
    <link href="assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="assets/js/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
    <style>
        th, td { white-space: nowrap; }
    </style>
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
                                <h3>All Available Books</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="courseslist" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-checkbox" id="multi-action-box" /></th>
                                                <th>Actions &nbsp; 
                                                    <button  class="btn btn-success btn-sm multi-activate-course multi-select" title="Change selected course status"><i class="btn-icon-only icon-check"> </i></button> 
                                                    <button class="btn btn-danger btn-sm multi-delete-course multi-select" title="Delete Selected"><i class="btn-icon-only icon-trash"> </i></button>
                                                </th>
                                                <th>ID</th>
                                                <th>Book Title</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Media</th>
                                                <th>Amount</th>
                                                <th>Book Image</th>
                                                <th>Date Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success hidden" id="hiddenUpdateForm">
                            <div class="panel-heading">
                                <h3>Edit Book Details</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" id="UpdateCourse" name="UpdateCourse" action="../REST/manage-courses.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Title:</label>
                                        <div class="controls">
                                            <input type="hidden" id="id" name="id" value=""/> <input type="hidden" id="oldFile" name="oldFile" value=""/>
                                            
                                            <input type="text" id="name" name="name" placeholder="book title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="category">Category:</label>
                                        <div class="controls">
                                            <select tabindex="1" name="category" id="category" data-placeholder="Select a category.." class="form-control">
                                                <option value="1">e-Book</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="description">Description:</label>
                                        <div class="controls">
                                            <textarea class="span5" id="description" name="description" class="form-control"></textarea>
                                            <script>
                                                var ckeditor = CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="image">Book Image <span class="text-danger"><em>(Recommended Size: width=400px, height=400px)</em></span>:</label> <span><strong id="oldImageComment"></strong></span>
                                        <div class="controls">
                                            <input data-title="book image" type="file" placeholder="book image" value="" id="image" name="image" data-original-title="Book image" class="form-control">
                                            <input type="hidden" id="oldImage" name="oldImage" value=""/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="file">Media (PDF/MS-Word for e-Books):</label>
                                        <div class="controls">
                                            <input data-title="book media" type="file" placeholder="book media" value="" id="file" name="file" data-original-title="book media" class="form-control">
                                            <span>Old media: <strong id="oldFileComment"></strong></span>
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
                                            <input data-title="book cost" type="number" placeholder="book cost" id="amount" name="amount" data-original-title="book cost" class="form-control" required="required">
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="hidden" name="updateThisCourse" id="updateThisCourse" value="updateThisCourse"/>
                                            <button type="submit" name="submitUpdateCourse" id="submitUpdateCourse" class="btn btn-danger">Update Book</button> &nbsp; &nbsp;
                                            <button type="button" class="btn btn-info" id="cancelEdit">Cancel</button>
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
    <script src="assets/js/jquery-ui.1.11.4.js"></script>
    <script src="assets/js/common-handler.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
    <script src="assets/js/gritter/js/jquery.gritter.min.js" type="text/javascript"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/manage-courses.js?<?php echo time(); ?>"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
