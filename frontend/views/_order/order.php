<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrderList */

$this->title = 'สั่งซื้อสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'Order Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-in">
    <div class="site-about">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>