<!--
Author: Mr. Hakim Mudor
FileName: index.php
Desc: description
Created:  Mon May 17 2021
-->
<?php

use common\models\ContentList;
use common\models\BannerList;
/* @var $this yii\web\View */


$this->title = ContentList::findOne(1)->slogan;


$banner_his = BannerList::findOne(1);
$banner_pro = BannerList::findOne(2);
$banner_nutri = BannerList::findOne(5);

?>
<style>
    .carousel-caption {
        text-align: left;
    }
</style>
<!-- First section -->
<div class="row">
    <div class="col-sm-8">
        <div class="feature" style="background: url(<?= 'storage' . $banner_his->images ?>) no-repeat center center;background-size: cover;">
            <div class="shack_burger">
                <div class="chicken">
                    <img src="images/logo_ratio.png" alt="Chicken" />
                </div>
                <?= $banner_his->detail ?>
            </div>
            <p class="caption"></p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="signature" style="background: url(<?= 'storage' . $banner_pro->images ?>) no-repeat;background-size: cover;">
            <div class="shape">
                <span class="flaticon flaticon-burger"></span>
                <p><?= $banner_pro->name ?></p>
            </div>
            <div class="signature_content">
                <?= $banner_pro->detail ?>
            </div>
        </div>
    </div>
</div><!-- first section end -->

<!-- Second section -->
<div class="row">
    <div class="col-md-6">
        <div class="classic">
            <img src="images/classic_bg.jpg">
            <a href="" class="classic_btn">ข่าวสาร</a>

            <div class="overlay">
                <h3>โฉมหน้า ไฉไลเบอร์เกอร์ ณ ปัตตานี เร็วๆนี้</h3>

                <p class="overlay_content">Instead of traditional cucumber pickles, legendary chef-owner Judy Rodgers accents her burgers with thin-cut zucchini strips pickled in apple cider vinegar, mustard seeds and turmeric.</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Carousel -->
        <div id="small_carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->

            <div class="carousel-caption">
                <h3><?= $banner_nutri->name ?></h3>
                <hr />

                <ul class="list-unstyled nutrition">
                    <li><?= $banner_nutri->detail ?></li>
                </ul>
            </div>

            <!-- carousel inner -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?= 'storage' . $banner_nutri->images ?>" alt="" />
                </div>
            </div><!-- carousel inner end -->
        </div><!-- Carousel end-->
    </div>
</div><!-- second section end -->

<!-- Third section -->
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <li data-target="#carousel" data-slide-to="<?= $i ?>" <?php if ($i == 0) {
                                                                        echo 'class="active"';
                                                                    } ?>></li>
        <?php } ?>
    </ol>

    <!-- carousel inner -->
    <div class="carousel-inner" role="listbox">
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class="item <?php if ($i == 0) {
                                    echo "active";
                                } ?>">
                <img src="images/large_slider_img.jpg" alt="Burger">

                <div class="carousel-caption">
                    <h2>ไร้เทียมทาน</h2>
                    <h3>เบอร์เกอร์เนื้อทอดกระเทียม</h3>

                    <p>Chef Wesley Genovart makes this over-the-top, Shake Shack–inspired burger with two thin stacked patties, thick-cut bacon, kimchi and a spicy homemade sauce.</p>

                    <div class="info_btn_shadow">
                        <a href="" class="info_btn">info & nutrition</a>
                    </div>
                </div>

                <div class="carousel-caption-right" style="    right: 64px;
    top: 64px;
    position: absolute;
    height: 150px;
  width: 150px;
  background-color: #e31c79;
  border-radius: 50%;
  text-align: center;
  vertical-align: middle;">
                    <h2 style="position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    margin-top: -19px;
    font-family: 'Pattaya';
    font-size: 48px;">50฿</h2>
                </div>
            </div>
        <?php } ?>
    </div><!-- carousel inner end -->
</div><!-- Carousel end-->

<!-- Forth section -->
<div class="row forth_sec">
    <div class="col-sm-4">
        <div class="menu">
            <a href="">
                <div class="inner_content">

                    <span class="flaticon flaticon-burger"></span>
                    <h2>menu</h2>

                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="drinks">
            <div class="inner_content">
                <span class="flaticon flaticon-drink"></span>
                <h2>drinks</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="sides">
            <div class="inner_content">
                <span class="flaticon flaticon-food"></span>
                <h2>sides</h2>
            </div>
        </div>
    </div>
</div><!-- forth section end -->

<!-- Lock -->
<section id="lock">
    <h2>SERVING MORE THAN JUST BURGERS</h2>
    <p>ตรวจแผนที่ตั้งร้านอาหารของเราได้จากข้างล่าง</p>
</section>

<!-- Map -->
<style type="text/css">
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
</style>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        const uluru = {
            lat: <?= ContentList::findOne(1)->latitude ?>,
            lng: <?= ContentList::findOne(1)->longitude ?>
        };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 18,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>
<div id="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.046834014203!2d100.4655511140957!3d7.0037680193383265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304d2843f559e17d%3A0xe298a8ba886c3f47!2sChailai%20Burger!5e0!3m2!1sth!2sth!4v1619936951551!5m2!1sth!2sth" width="100%" height="360" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAJkXM_jng39-GaLvj7-mqrGDtrzad-hs&callback=initMap&libraries=&v=weekly" async></script>