<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Humming</b>bird</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Enter your username and password to login:') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?=
                $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => Yii::t('app', 'Username')])
        ?>

        <?=
                $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => Yii::t('app', 'Password')])
        ?>

        <div class="row">
            <div class="col-xs-8">
            <?= $form->field($model, 'rememberMe')->label(Yii::t('app', 'Remember Me'))->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
            <?= Html::submitButton(Yii::t('app', 'Login'), [
                'class' => 'btn btn-primary btn-block btn-flat',
                'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <a href="<?= Url::to('reset-password')?>"><?= Yii::t('app', 'Forget password') ?></a><br>
        <a href="register.html" class="text-center"><?= Yii::t('app', 'Not registerd? Sign up now.') ?></a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
