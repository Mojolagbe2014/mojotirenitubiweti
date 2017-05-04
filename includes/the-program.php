            <!--The Program section-->
            <section id="program" class="product">
                <div class="container">
                    <div class="main_product roomy-80">
                        <div class="head_title text-center fix">
                            <h2 class="text-uppercase">The FINANCIAL EXCELLENCE seminars</h2>
                            <h5>The are numerous financial seminars – what’s different about this?</h5>
                        </div>

                        <div class="text-justify">
                            <?php echo Setting::getValue($dbObj, 'THE_PROGRAM') ? Setting::getValue($dbObj, 'THE_PROGRAM') : ''; ?>
                        </div>
                    </div><!-- End of row -->
                </div><!-- End of container -->
            </section><!-- End of The Program section -->