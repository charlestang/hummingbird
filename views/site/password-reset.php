<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Password Reset');

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Humming</b>bird</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Enter your register email:') ?></p>

        <form action="/site/password-reset" method="post" role="form">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">

            <div class="form-group has-feedback field-loginform-username required">
                <input type="text" class="form-control" name="email" placeholder="<?= Yii::t('app', 'Email')?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <p class="help-block help-block-error"></p>
            </div>

            <div class="row">
                <div class="col-xs-7">
                </div>
                <!-- /.col -->
                <div class="col-xs-5">
                <?= Html::submitButton(Yii::t('app', 'Find Password'), [
                    'class' => 'btn btn-primary btn-block btn-flat',
                    'name' => 'login-button']) ?>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="<?= Url::to('login')?>"><?= Yii::t('app', '&larr; Return login') ?></a><br>
        <a href="register.html" class="text-center"><?= Yii::t('app', 'Not registerd? Sign up now.') ?></a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
