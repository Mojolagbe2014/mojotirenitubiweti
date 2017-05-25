            <section id="register" class="brand fix roomy-80">
                <div class="container">
                    <div class="row">
                        <div class="main_brand text-center">
                            <div class="head_title text-center">
                                <h2 class="text-uppercase">Register Today!</h2>
                            </div>
                            <div class="contact-cont">
                                <form class="well form-horizontal" action="" method="post"  id="contactus">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Full Name</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input  name="fname" id="fname" required="yes" placeholder="Full Name" class="form-control"  type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">E-Mail</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input name="email" required="yes" placeholder="E-Mail Address" class="form-control"  type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Phone #</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                    <input name="telephone" required="yes" placeholder="Phone" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Address</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                    <input name="address" required="yes" placeholder="Address" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Country</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                    <input name="country" required="yes" placeholder="Country" class="form-control"  type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"> 
                                            <label class="col-md-3 control-label">Province</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                    <select name="state" required="yes" class="form-control selectpicker" >
                                                        <option value=" " >Please select your state</option>
                                                        <option value="Ontario">Ontario</option>
                                                        <option value="Quebec">Quebec</option>
                                                        <option value="Nova Scotia">Nova Scotia</option>
                                                        <option value="New Brunswick">New Brunswick</option>
                                                        <option value="Manitoba">Manitoba</option>
                                                        <option value="British Columbia">British Columbia</option>
                                                        <option value="Prince Edward Island">Prince Edward Island</option>
                                                        <option value="Saskatchewan">Saskatchewan</option>
                                                        <option value="Alberta">Alberta</option>
                                                        <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Postal Code</label>  
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                    <input name="post" required="yes" placeholder="Postal Code" class="form-control"  type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-md-3 control-label">Message</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                    <textarea required="yes" class="form-control" name="message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-md-3 control-label">Captcha</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <img src="<?php echo SITE_URL; ?>captcha.php" id="captcha"><br>
                                                    <!-- CHANGE TEXT LINK -->
                                                    <a href="javascript:;" onclick="document.getElementById('captcha').src='captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image">Not readable? Change text.</a><br><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-md-3 control-label">Captcha Code</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    <input  required="yes" name="captcha" value="" id="captcha-form" autocomplete="off" class="form-control"  type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" name="submit" class="btn btn-danger" >Send <span class="fa fa-send"></span></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#bottom-->