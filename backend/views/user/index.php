<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'status',
            'created_at',

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