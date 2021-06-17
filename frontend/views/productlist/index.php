<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-in">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'cid',
            'name',
            'detail:ntext',
            //'images',
            //'price',
            //'discount',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>