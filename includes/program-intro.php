            <!--The Program Intro Section-->
            <section id="program-intro" class="business bg-grey roomy-70">
                <div class="container">
                    <div class="row">
                        <?php 
                        foreach ($programObj->fetchRaw("*", " status = 1 ", " date_added DESC LIMIT 1") as $news) {
                            $newsData = array('id' => 'id', 'title' => 'title', 'image' => 'image', 'description' => 'description', 'dateAdded' => 'date_added', 'status' => 'status');
                            foreach ($newsData as $key => $value){
                                switch ($key) { 
                                    case 'image': $programObj->$key = MEDIA_FILES_PATH1.'news/'.$news[$value];break;
                                    default     :   $programObj->$key = $news[$value]; break; 
                                }
                            }
                        ?>
                        <div class="main_business">
                            <div class="col-md-6">
                                <div class="business_slid">
                                    <div class="slid_shap bg-grey"></div>
                                    <div class="business_items text-center">
                                        <div class="business_item">
                                            <div class="business_img">
                                                <img src="<?php echo $programObj->image; ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="business_item sm-m-top-50">
                                    <h2 class="text-uppercase"><?php echo $programObj->title; ?></h2>
                                    <p>
                                        <?php echo $programObj->description; ?>
                                    </p>
                                    <div class="business_btn inner-link">
                                        <a href="#program" class="btn btn-default m-top-20">Read More</a>
                                        <a href="#register" class="btn btn-primary m-top-20">Register Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section><!-- End off Business section -->