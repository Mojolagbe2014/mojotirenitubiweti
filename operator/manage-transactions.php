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
    <title>Manage Transaction Records  - Train2bWealthy</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="images/icons/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="assets/js/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
</head>
<body>
     <div id="wrapper">
        <?php include('includes/top-bar.php'); ?> 
        <!-- /. NAV TOP  -->
        <?php include('includes/side-bar.php'); ?> 
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="messageBox"></div>
                    <!--/.span3-->
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>All Transactions</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="transactionslist" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-checkbox" id="multi-action-box" /></th>
                                                <th>Action <br/> 
                                                    <button  class="btn btn-success btn-sm multi-activate-book multi-select" title="Change selected item(s) status"><i class="btn-icon-only icon-check"> </i></button> 
                                                    <button class="btn btn-danger btn-sm multi-delete-book multi-select" title="Delete Selected"><i class="btn-icon-only icon-trash"> </i></button>
                                                </th>
                                                <th>Transaction ID</th>
                                                <th>Buyer Name</th>
                                                <th>Course Purchased</th>
                                                <th>Item Type</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                                <th>Method</th>
                                                <th>Date Purchased</th>
                                                <th>Payment Mode</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="messageBox"></div>
                        <div class="panel panel-info hidden" id="hiddenUpdateForm">
                            <div class="panel-heading">
                                <h3>Log Manual Payment</h3>
                            </div>
                           <div class="messageBox"></div>
                            <div class="panel-body">
                                <form role="form" id="AddTransaction" name="AddTransaction" action="../REST/add-purchase-course.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label" for="transactionId">Teller No/Transaction ID:</label>
                                    <div class="controls">
                                        <input type="hidden" id="method" name="method" value="Manual Log" />
                                        <input type="hidden" id="state" name="state" value="approved" />
                                        <input type="text" id="transactionId" name="transactionId" value="" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="user">Paid By:</label>
                                    <div class="controls">
                                        <select name="user" id="user" required="required" class="form-control">
                                            <option value=""> -- Select Payer -- </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="itemType">Payment For:</label>
                                    <div class="controls">
                                        <select name="itemType" id="itemType" required="required" class="form-control">
                                            <option value=""> -- Select Course Type -- </option>
                                            <option value="course">Single Course</option>
                                            <option value="category">Course Category</option>
                                            <option value="sub-category">Sub-Category</option>
                                        </select>
                                    </div>
                                    <div class="controls">
                                        <select name="course" id="course" required="required" class="form-control">
                                            <option value=""> -- Select Course -- </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="amount">Amount:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Amount Paid" id="amount" name="amount" class="form-control tip" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="currency">Currency:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Currency e.g GBP, NGN" id="currency" name="currency" class="form-control tip" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="mode">Payment Mode:</label>
                                    <div class="controls">
                                        <select name="mode" id="mode" required="required" class="form-control">
                                            <option value=""> -- Select Mode -- </option>
                                            <option value="full">Full Payment</option>
                                            <option value="installment">Installment Payment</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="datePurchased">Payment Date/Time:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Date Purchased" id="datePurchased" name="datePurchased" class="form-control tip" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="controls">
                                        <button type="submit" name="logThisPayment" id="logThisPayment" class="btn btn-danger">Log Payment</button> &nbsp; &nbsp;
                                        <button type="reset" class="btn btn-info" id="cancelEdit">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="messageBox"></div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
     </div>
    
      <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/common-handler.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
    <script src="assets/js/gritter/js/jquery.gritter.min.js" type="text/javascript"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/manage-transactions.js?<?php echo time(); ?>"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>