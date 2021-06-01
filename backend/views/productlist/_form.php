<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProductList */
/* @var $model common\models\ProductAtt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-list-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($model->getCatagoryList(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagePath', [
        'template' => '
                            <div class="custom-file">
                                {input}
                                {label}
                                {error}
                            </div>
        ',
        'inputOptions' => [
            'class' => 'custom-file-input'
        ],
        'labelOptions' => [
            'class' => 'custom-file-label'
        ]
    ])->textInput(['type' => 'file']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>