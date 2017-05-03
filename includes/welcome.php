            <!--Welcome Section-->
            <section id="welcome" class="features">
                <div class="container">
                    <div class="row">
                        <div class="main_features fix roomy-70">
                            <div class="head_title text-center">
                                <h2 class="text-uppercase">Welcome..</h2>
                            </div>
                            <div class="col-md-5 text-justify">
                                <?php echo WELCOME_MESSAGE; ?>
                            </div>
                            <?php 
                            $nums = 1; $addStyles = '';
                            $icons = array('thumbs-o-up', 'file-excel-o', 'money', 'check-square-o');
                            foreach ($settingObj->fetchRaw("*", " name LIKE 'WELCOME_MENU%' ", " name ASC ") as $setting) {
                                    $settingData = array('name' => 'name', 'value' => 'value');
                                    foreach ($settingData as $key => $value){
                                        switch ($key) {  default     :  $settingObj->$key = $setting[$value]; break; }
                                    }
                                    $slugifiedMenu = StringManipulator::slugify(strip_tags($settingObj->value));
                                    $currItem = str_replace("WELCOME_MENU_", "", $settingObj->name);
                                    $icon = $icons[intval($currItem) - 1] ? $icons[intval($currItem) - 1] : "bookmark";
                            ?>
                            <div class="col-md-7">
                                <div class="features_item sm-m-top-30">
                                    <div class="f_item_icon">
                                        <i class="fa fa-<?php echo $icon; ?>"></i>
                                    </div>
                                    <div class="f_item_text text-justify">
                                        <h3><?php echo $settingObj->value; ?></h3>
                                        <p><?php echo Setting::getValue($dbObj, str_replace("MENU", "CONTENT", $settingObj->name)) ? StringManipulator::trimStringToFullWord(670, Setting::getValue($dbObj, str_replace("MENU", "CONTENT", $settingObj->name))) : ''; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php $nums++; } ?>
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Welcome Section-->
