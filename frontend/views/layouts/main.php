<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Button;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\ContentList;
use common\models\BannerList;

AppAsset::register($this);

$banner_top  = BannerList::findOne(4);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1">
    <script>
        if (screen.width < 1000) {
            var viewport = document.querySelector("meta[name=viewport]");
            viewport.parentNode.removeChild(viewport);

            var newViewport = document.createElement("meta");
            newViewport.setAttribute("name", "viewport");
            newViewport.setAttribute("content", "width=1000");
            document.head.appendChild(newViewport);
        }
    </script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= ContentList::findOne(1)->title ?> - <?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <?php $this->head() ?>
</head>

<body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
    <?php $this->beginBody() ?>
    <!-- Preloader -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
                <div class="object" id="object_five"></div>
                <div class="object" id="object_six"></div>
                <div class="object" id="object_seven"></div>
                <div class="object" id="object_eight"></div>
                <div class="object" id="object_big"></div>
            </div>
        </div>
    </div>
    <!--End Preloader -->
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt' => Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar navbar-default bootsnav no-background navbar-fixed black',
        ],
    ]);
    $menuItems = [
        ['label' => 'เกี่ยวกับเรา', 'url' => ['/site/about']],
        ['label' => 'ติดต่อ', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'สมัครสมาชิก', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'เข้าสุ่ระบบ', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'ออกจากระบบ (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    $menuItems[] = ['label' => 'สั่งซื้อสินค้า', 'url' => ['/orderlist/index']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <?php if (strpos(Url::current(), "index.php?r=site%2Findex") !== false) { ?>
        <!-- Header -->
        <header id="hello" style="background: url(<?= 'storage' . $banner_top->images ?>) no-repeat;background-size: cover;">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="banner">
                            <h1><?= $banner_top->name ?></h1>
                            <div class="inner_banner">
                                <div class="banner_content">
                                    <?= $banner_top->detail ?>
                                </div>
                                <div class="stamp">
                                    <img src="images/stamp.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Container end -->
            <p class="caption">*Limited Time Only</p>
        </header><!-- Header end -->
    <?php } else { ?>
        <div style="background-color: #e31c79;height: 80px;"></div>
    <?php } ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <section id="block">
        <div class="container">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <!-- Container -->
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-sm-4 col-xs-12 col-lg-offset-1 pull-right">
                    <div class="subscribe">
                        <p><a href="">เกี่ยวกับเรา</a></p>
                        <p><a href="">สั่งอาหาร</a></p>
                        <p><a href="">ติดต่อ</a></p>
                        <p><a href="http://admin.chailaiburger.asia/" target="_blank">ระบบหลังบ้าน</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-xs-12 col-lg-offset-1 pull-right">
                    <div class="contact_us">
                        <h4>ติดต่อสอบถาม</h4>
                        <a href=""><?= ContentList::findOne(1)->email ?></a>

                        <address>
                            <?= ContentList::findOne(1)->address ?>
                        </address>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 col-xs-12 pull-right">
                    <div class="basic_info">
                        <a href=""><img class="footer_logo" src="images/footer_logo.png" alt="Burger" /></a>

                        <ul class="list-inline social">
                            <li><a href="<?= ContentList::findOne(1)->facebook ?>" target="_blank" class="fab fa-facebook"></a></li>
                            <li><a href="<?= ContentList::findOne(1)->instragram ?>" target="_blank" class="fab fa-instagram"></a></li>
                            <li><a href="<?= ContentList::findOne(1)->line ?>" target="_blank" class="fab fa-line"></a></li>

                        </ul>

                        <div class="footer-copyright">
                            <p class="wow fadeInRight" data-wow-duration="1s">
                                Made by
                                <a target="_blank" href="http://kimookpong.com">Kimookpong</a> <br />
                                2021 © Ottoman Enterprise Co., Ltd.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- Container end -->
    </footer><!-- Footer end -->



    <!-- scroll up-->
    <div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>