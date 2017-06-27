            <div id="paypage" class="hidden">
                <h4></h4>
                <form id="payform" class="well form-horizontal" action="" method="post">
<!--                    <div class="form-group">
                        <label class="col-md-2 control-label">Units</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input name="units" id="units" required="yes" placeholder="Units" class="form-control"  type="number" value="1">
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Price:</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="hidden" id="book" name="book" value="" required="required"/>
                                <input name="units" id="units" type="hidden" value="1">
                                <input name="currency" id="currency" type="hidden" value="CAD">
                                <input name="category" id="category" type="hidden" value="">
                                <input type="hidden" id="amount" name="amount" value="" required="required"/>
                                <input name="amounts" id="amounts" placeholder="amount" class="form-control"  type="number" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <legend>Buyer Details</legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Buyer Name</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input  name="buyerName" id="buyerName" required="yes" placeholder="Buyer's Name" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">E-Mail</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input name="buyerEmail" required="required" placeholder="Buyer's E-Mail Address" class="form-control"  type="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone #</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input name="buyerPhone" required="yes" placeholder="Buyer's Phone" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                <input name="buyerAddress" required="yes" placeholder="Buyer's Address" class="form-control" type="text">
                            </div>
                        </div>
                    </div>

                    <legend>Card Details </legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Card Holder</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                                <input name="cardHolder" required="yes" placeholder="Card Holder's Name" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Card Number</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <input name="cardNumber" required="yes" placeholder="Card Number" class="form-control" type="text" type="text" pattern=".{16,19}" title="16 to 19 characters" maxlength="19"> <br/>
                                <small class="text-info sm-text-center"><q>We don’t take AMERICAN EXPRESS</q></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Expiry Date</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                <input name="expiryDate" required="required" placeholder="MM/YY" class="form-control" type="text" pattern=".{4,}" title="4 to 5 characters"  maxlength="5">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">CVC/CVV</label>  
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input name="cardCVC" required="yes" placeholder="CVC/CVV" class="form-control" type="password" pattern=".{3,}" title="3 characters"  maxlength="3">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-8 text-center">
                            <button type="submit" name="submitPayment" class="btn btn-warning btn-sm" style="padding:8px 8px;" title="Pay Now! No Refunds">Pay Now <span class="fa fa-send"></span></button>
                            <strong class="text-danger"  style="padding:8px 8px;"><u> NO REFUNDS</u></strong>
                        </div>
                    </div>
                </form>
            </div>