<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Database */

$this->title                   = Yii::t('app', 'Add Database');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Databases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="database-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
