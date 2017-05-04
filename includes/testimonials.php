            <!--Testimonial section-->
            <section id="test" class="test bg-grey roomy-60 fix">
                <div class="container">
                    <div class="row">                        
                        <div class="main_test fix">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="head_title text-center fix">
                                    <h2 class="text-uppercase">Testimonials</h2>
                                    <h5>What our clients say...</h5>
                                </div>
                            </div>
                            <?php 
                                $num = 1;
                                $totDisplTest = Setting::getValue($dbObj, 'TOTAL_DISPLAYABLE_TESTIMONIAL') ? trim(stripcslashes(strip_tags(Setting::getValue($dbObj, 'TOTAL_DISPLAYABLE_TESTIMONIAL')))) : 50;
                                foreach($testimonialObj->fetchRaw("*", " 1=1 ", " RAND() LIMIT $totDisplTest") as $testimonial) { 
                                    $activeMenu = $num == 1 ? "active " : "";
                                    $testImage = ($testimonial['image'] =="") ? MEDIA_FILES_PATH1.'testimonial/'.'noimage.jpg' : MEDIA_FILES_PATH1.'testimonial/'.$testimonial['image'];
                            ?>
                            <div class="col-md-6">
                                <div class="test_item fix">
                                    <div class="item_img">
                                        <img class="img-circle" src="<?php echo $testImage; ?>" alt="" />
                                        <i class="fa fa-quote-left"></i>
                                    </div>

                                    <div class="item_text">
                                        <h5><?php echo $testimonial['author']; ?></h5>
                                        <p class="text-justify"><?php echo StringManipulator::trimStringToFullWord(600, $testimonial['content']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section><!-- End of Testimonial section -->