            <footer id="contact" class="footer action-lage bg-black p-top-80">
                <!--<div class="action-lage"></div>-->
                <div class="container">
                    <div class="row">
                        <div class="widget_area">
                            <div class="col-md-6">
                                <div class="widget_item widget_about">
                                    <h5 class="text-dark-blue">About Us</h5>
                                    <p class="m-top-20"><?php echo Setting::getValue($dbObj, 'ABOUT_US') ? strip_tags(Setting::getValue($dbObj, 'ABOUT_US'), '<br/>') : ''; ?></p>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-location-arrow"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-dark-blue">Location</h6>
                                            <p><?php echo COMPANY_ADDRESS; ?></p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-phone"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-dark-blue">Phone :</h6>
                                            <p><?php echo COMPANY_HOTLINE; ?></p>
                                        </div>
                                    </div>
                                    <div class="widget_ab_item m-top-30">
                                        <div class="item_icon"><i class="fa fa-envelope-o"></i></div>
                                        <div class="widget_ab_item_text">
                                            <h6 class="text-dark-blue">Email Address :</h6>
                                            <p><?php echo COMPANY_EMAIL; ?></p>
                                        </div>
                                    </div>
                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->

                            

                            <div class="col-md-6">
                                <div class="widget_item widget_newsletter sm-m-top-50">
                                    <h5 class="text-white">Subscribe to Our Newsletter</h5>
                                    <form class="m-top-30 well form-horizontal" action="<?php echo SITE_URL; ?>REST/subscribe.php" method="post" id="subscribeForm">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Name</label>  
                                                <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        <input  name="subscriberName" id="subscriberName" required="yes" placeholder="Full Name" class="form-control"  type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">E-Mail</label>  
                                                <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input name="subscriberEmail" required="yes" placeholder="E-Mail Address" class="form-control"  type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>  
                                                <div class="col-md-8">
                                                    <button type="submit" name="subscriberSubmit" class="btn" ><i class="fa fa-send"></i></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <ul class="list-inline m-top-20">
                                        <li>- <a href="<?php echo FACEBOOK_LINK; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="<?php echo TWITTER_LINK; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php echo LINKEDIN_LINK; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="<?php echo GOOGLEPLUS_LINK; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="<?php echo YOUTUBE_LINK; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                        <li><a href="<?php echo DRIBBBLE_LINK; ?>" target="_blank"><i class="fa fa-dribbble"></i></a> -</li>
                                    </ul>

                                </div><!-- End off widget item -->
                            </div><!-- End off col-md-3 -->
                        </div>
                    </div>
                </div>
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 m-top-80">
                    <div class="col-md-12">
                        <p class="wow fadeInRigh text-white" data-wow-duration="1s">
                            Developed  by:  
                            <a href="http://timca.6te.net" target="_blank" rel="nofollow">TIMCA Computers Inc</a> 
                            &copy; <?php echo date("Y"); ?>. All Rights Reserved
                        </p>
                    </div>
                </div>
            </footer>
            <?php echo Setting::getValue($dbObj, 'ADDTHIS_SHARE_BUTTON') ? Setting::getValue($dbObj, 'ADDTHIS_SHARE_BUTTON') : ''; ?>
