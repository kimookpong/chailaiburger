<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container-in" style="margin-top: 30px;">
<div class="site-error" style="margin: 100px 0;">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        เว็บไซต์หน้านี้ไม่สามารถใช้งานได้
    </p>
    <p>
        กรุณาติดต่อเจ้าหน้าที่ ไฉไลเบอร์เกอร์
    </p>

</div>
</div>
