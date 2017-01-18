<?php

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title                   = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=

$this->render('_form', [
    'title' => Yii::t('app', 'Add new user:'),
    'model' => $model,
])
?>

