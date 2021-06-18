<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProductList;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model common\models\OrderList */

$this->title = 'สั่งซื้อสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'Order Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-in">
    <div class="site-about">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="order-list-form">
            <div style="margin: 20px 0;">
                <h3 class="card-title">รายการสั่งซื้อ</h3>
            </div>
            <table class="table table-dark">
                <tbody>
                    <?php
                    $modelItem = ProductList::find()->all();

                    foreach ($modelItem as $item) {
                        if (isset($_COOKIE['item' . $item->id]) && $_COOKIE['item' . $item->id] > 0) {
                            $val = $_COOKIE['item' . $item->id];
                            $class_sel = "display:block;";
                            $class_xsel = "display:none;";
                            $style_sel = "background-color: #e31c79; color: #f0e848;";

                    ?>
                            <tr>
                                <th style="width:75%" scope="row">
                                    <?= $val ?> X <?= $item->name ?>
                                </th>
                                <td style="width:10%;text-align: right;">
                                    <?php if ($item->discount > 0) {
                                        echo $item->discount;
                                    } else {
                                        echo  $item->price;
                                    }
                                    ?>.00 ฿
                                </td>
                                <td style="width:15%;">

                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr>
                        <th style="width:75%;text-align: right;" scope="row">มีสินค้า <span id="totalCart"><?= isset($_COOKIE['totalCart']) ? $_COOKIE['totalCart'] : 0 ?></span> รายการ</th>
                        <td style="width:10%;text-align: right;"><span id="totalPrice"><?= isset($_COOKIE['totalPrice']) ? $_COOKIE['totalPrice'] : 0 ?></span>.00 ฿</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div style="margin: 20px 0;">
                <h3 class="card-title">รายละเอียดการจัดส่ง</h3>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12 col-lg-12">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-6">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-6">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-lg-6">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center;">
                    <?= Html::submitButton('ตกลงการสั่งซื้อ', ['class' => 'btn btn-success']) ?>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>