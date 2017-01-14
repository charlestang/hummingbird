<?php

use yii\helpers\Url;
use yii\web\View;
/* @var $this View */

$this->title = false;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Congratulations!') ?></h1>

        <p class="lead"><?= Yii::t('app', 'Welcome to Hummingbird reporting system!') ?></p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['/report/create']) ?>"><?= Yii::t('app', 'Create Report') ?></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
            </div>
        </div>

    </div>
</div>
