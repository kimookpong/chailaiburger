<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = "ขอบคุณสำหรับการสั่งซื้อ";
?>
<div class="container-in" style="margin-top: 30px;">
    <div class="site-error" style="text-align: center;">

        <h1 style="margin: 30px;"><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-success">
            ท่านได้สั่งซื้อสินค้าสำเร็จแล้ว
        </div>
        <p>
            ทางทีมงานของเราจะติดต่อกลับไปตามเบอร์ติดต่อที่ให้ไว้ครับ
        </p>
        <p>
            @ไฉไลเบอร์เกอร์ สาขาปัตตานี
        </p>

    </div>
</div>