<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContentList */

$this->title = 'Create Content List';
$this->params['breadcrumbs'][] = ['label' => 'Content Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
