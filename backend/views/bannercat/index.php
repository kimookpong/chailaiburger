<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Cats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Cat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'detail',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>', $url, [
                            'title' => Yii::t('app', 'แก้ไขข้อมูล'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>', $url, [
                            'title' => Yii::t('app', 'ลบ'),
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'ต้องการลบข้อมูล?',
                            ],
                        ]);
                    }

                ],
            ],
        ],
    ]); ?>


</div>