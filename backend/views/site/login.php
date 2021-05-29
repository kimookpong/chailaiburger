<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>CHAILAI</b>ADMIN</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
	  <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
      <?= $form->field($model, 'password')->passwordInput() ?>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
				<?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
          </div>
          <!-- /.col -->
        </div>
      <?php ActiveForm::end(); ?>
<!--
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>

      <p class="mb-1">
        <a href="index.php?r=site%2Frequest-password-reset">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="index.php?r=site%2Fsignup" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->