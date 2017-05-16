            <!--Home Sections-->
            <section id="home" class="home bg-black fix">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="col-md-12">
                                <div class="hello_slid">
                                    <?php 
                                    $addStyle = '';
                                    foreach ($sliderObj->fetchRaw("*", " status = 1 ", " orders ASC ") as $slider) {
                                        $sliderData = array('id' => 'id', 'title' => 'title', 'content' => 'content', 'orders' => 'orders', 'status' => 'status', 'image' => 'image');
                                        foreach ($sliderData as $key => $value){
                                            switch ($key) { 
                                                case 'image': $sliderObj->$key = MEDIA_FILES_PATH1.'slider/'.$slider[$value];break;
                                                default     :   $sliderObj->$key = $slider[$value]; break; 
                                            }
                                        }
                                        $addStyle = $sliderObj->orders == 1 ? 'image-fam' : ''; 
                                        //$sliderObj->image = new ThumbNail($sliderObj->image, 80, 80);
                                    ?>
                                    <div class="slid_item">
                                        <div class="home_text ">
                                            <h2 class="text-white">Welcome to <strong><?php echo WEBSITE_AUTHOR; ?></strong></h2>
                                            <h1 class="text-white"><?php echo $sliderObj->title; ?></h1>
                                            <h3 class="text-white">- <?php echo $sliderObj->content; ?> -</h3>
                                        </div>

                                        <div class="home_btns m-top-40 inner-link">
                                            <a href="#register" class="btn btn-primary m-top-20">Register Now</a>
                                            <a href="#program" class="btn btn-default m-top-20">Take a Tour</a>
                                        </div>
                                    </div><!-- End off slid item -->
                                    <?php } ?>
                                </div>
                            </div>

                        </div>


                    </div><!--End off row-->
                </div><!--End off container -->
            </section> 
            <!--End off Home Sections-->