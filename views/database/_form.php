<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Database */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="database-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'database')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'charset')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=
        Html::submitButton(
                $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        )
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
