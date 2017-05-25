<!--Test section-->
            <section id="product" class="product bg-grey roomy-50 fix">
                <div class="container">
                    <div class="main_product">
                        <div class="head_title text-center fix">
                            <h2 class="text-uppercase">Store</h2>
                            <h5>List of available eBooks</h5>
                        </div>

                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <?php 
                                $itemsPerPage = intval(strip_tags(Setting::getValue($dbObj, 'BOOKS_PER_PAGE'))) ? strip_tags(Setting::getValue($dbObj, 'BOOKS_PER_PAGE')) : 4;
                                $totalBooks = Book::getRawCount($dbObj, ' status = 1 ');
                                $noOfPages = ceil($totalBooks/$itemsPerPage);
                            ?>
                            <ol class="carousel-indicators">
                                <?php 
                                for($count = 0; $count < $noOfPages; $count++){
                                    $active = $count == 0 ? 'active' : '';
                                ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo count; ?>" class="<?php echo $active; ?>"></li>
                                <?php } ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                for($count = 1; $count <= $noOfPages; $count++){
                                    $active = $count == 1 ? 'active' : '';
                                ?>
                                <div class="item <?php echo $active; ?>">
                                    <div class="container">
                                        <div class="row">
                                            <?php  
                                            $offset = ($count - 1) * $itemsPerPage;
                                            foreach($bookObj->fetchRaw("*", " status=1 ", " id DESC LIMIT $itemsPerPage OFFSET $offset ")as $book) {
                                                $bookObj->image = MEDIA_FILES_PATH1.'book-image/'.$book['image'];
                                                $thumb = new ThumbNail("media/book-image/".$book['image'], 290, 250);
                                                $book['currency'] = $book['currency'] == "CAD" ? "CA$" : $book['currency'];
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="port_item xs-m-top-30">
                                                    <div class="port_img">
                                                        <img src="<?php echo SITE_URL.$thumb; ?>" alt="" />
                                                        <div class="port_overlay text-center">
                                                            <a href="<?php echo $bookObj->image; ?>" class="popup-img">+</a>
                                                        </div>
                                                    </div>
                                                    <div class="text-center port_caption port m-top-20">
                                                        <h5 class="text-dark-blue"><?php echo strtoupper($book['name']); ?></h5>
                                                        <h3 class="text-danger"><i class="fa fa-money"></i> <?php echo $book['currency'].' '.number_format($book['amount'], 2); ?></h3>
                                                        <p class="text-justify">
                                                            <i class="fa fa-quote-left"></i> 
                                                            <?php echo StringManipulator::trimStringToFullWord(160, strip_tags($book['description'])); ?> 
                                                            <i class="fa fa-quote-right"></i>
                                                        </p>
                                                        <div class="m-top-10">
                                                            <button  class="book-now btn btn-primary m-top-10" 
                                                                     data-id="<?php echo $book['id']; ?>" data-name="<?php echo $book['name']; ?>"
                                                                     data-amount="<?php echo $book['amount']; ?>" data-currency="<?php echo $book['currency']; ?>"
                                                                     >Buy Now!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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
                </div>
            </section><!-- End off test section -->