<?php

use dmstr\web\AdminLteAsset;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
    </head>
    <body class="login-page">

        <?php $this->beginBody() ?>

        <?= $content ?>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
