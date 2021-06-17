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
    <div class="card-body row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'cid')->dropDownList(ArrayHelper::map($model->getCatagoryList(), 'id', 'name')) ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'detail')->textarea(['rows' => 6, 'id' => 'summernote']) ?>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="form-group" style="text-align: center;">
                <span id="imageShow">
                    <?php if (isset($model->images)) { ?>
                        <?= Html::img($model->getImageUrl(), ['style' => 'height:150px']) ?>
                    <?php } ?>
                </span>
                <div id="loading-screen" style="display: none;">
                    <?= Html::img('images/loading.gif', ['style' => 'height:150px;']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'imagePath', [
                'template' => '
                            <div class="custom-file">
                                {input}
                                {label}
                                {error}
                                <div class="help-block">ขนาดไฟล์ภาพที่แนะนำ: 1140 x 600 pixels</div>
                            </div>
        ',
                'inputOptions' => [
                    'class' => 'custom-file-input',
                    'onchange' => 'loadFile(event)'
                ],
                'labelOptions' => [
                    'class' => 'custom-file-label'
                ]
            ])->textInput(['type' => 'file']) ?>
            <script>
                var loadFile = function(event) {
                    $('#loading-screen').show();
                    src = URL.createObjectURL(event.target.files[0]);
                    $('#imageShow').html('<img src="' + src + '" alt="" style="height:150px">');
                    $('#loading-screen').hide();
                };
            </script>
        </div>
        <div class="col-md-12 col-lg-12">
            <?= Html::submitButton('<i class="fa fa-save"></i> บันทึก', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-times"></i> ยกเลิก', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>