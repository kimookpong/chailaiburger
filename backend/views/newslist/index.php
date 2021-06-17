<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6" style="text-align:right;">
                            <?= Html::a('Create new', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => ['class' => 'table table-striped projects'],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'label' => 'images',
                                        'attribute' => 'Product Image',
                                        'content' => function ($model) {
                                            /** @var \common\models\ProductList $model */
                                            return Html::img($model->getImageUrl(), ['style' => 'height:50px']);
                                        }
                                    ],
                                    [
                                        'attribute' => 'cid',
                                        'content' => function ($model) {
                                            return $model->catagory->name;
                                        }
                                    ],
                                    'name',
                                    [
                                        'attribute' => 'created_at',
                                        'content' => function ($model) {
                                            return Yii::$app->helpers->getDateTime($model->created_at) . '<br><small>โดย: ' . User::findIdentity($model->created_by)->username . '</small>';
                                        }
                                    ],
                                    [
                                        'attribute' => 'updated_at',
                                        'content' => function ($model) {
                                            return ($model->created_at != $model->updated_at) ? Yii::$app->helpers->getDateTime($model->updated_at) . '<br><small>โดย: ' . User::findIdentity($model->updated_by)->username . '</small>' : "";
                                        }
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Action',
                                        'template' => '{update}',
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>