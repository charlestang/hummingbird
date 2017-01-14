<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = Yii::t('app', 'Report: ') . Html::encode($report->name);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="box box-info collapsed-box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Detail information')?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body box-comments">
                <div class="box-comment">
                    <div class="comment-text">
                        <span class="username">
                            <?= Yii::t('app', 'Creator: ')?><?= Html::encode($report->user->username)?>
                            <span class="text-muted pull-right"><?= Yii::t('app', 'Created at: ')?><?= Html::encode($report->created_at)?></span>
                        </span><!-- /.username -->
                        <?= Html::encode($report->description)?>
                        <p><?= Yii::t('app', 'Last updated at: ')?><?=Html::encode($report->updated_at)?></p>
                    </div><!-- /.comment-text -->
                </div>
                <pre class="sql-syntax-analyze"><?=$sqlForm->getBeautifiedVersion()?></pre>
            </div>
            <div class="box-footer"></div>
        </div>

        <?php if (!empty($results) || $exception) : ?>
            <div class="box box-success">
                <?php if (count($results) > 0) : ?>
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-list-alt text-info"></i> <?= Yii::t('app', 'Query results')?>
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a class="btn btn-default btn-export" href="<?= Url::to(['/report/export-by-id', 'id' => $report->id])?>" target="_blank">
                                    <i class="fa fa-download text-danger"></i>
                                    <?= Yii::t('app', 'Export')?>
                                </a>
                                <a class="btn btn-default" href="<?= Url::toRoute(['/report/update', 'id' => $report->id])?>">
                                    <i class="fa fa-edit text-danger"></i>
                                    <?= Yii::t('app', 'Edit')?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- .box-body -->
                    <div class="box-body no-padding">
                        <?= $this->render('_results', [ 'results' => $results]) ?>
                    </div>
                    <!-- /.box-body -->
                <?php endif; ?>
                <!-- .box-footer -->
                <div class="box-footer">
                    <?php if ($exception): ?>
                        <div class="grid full">
                            <pre class="text-danger"><?= Html::encode($exception) ?></pre>
                        </div>
                    <?php endif ?>
                </div>
                <!-- /.box-footer -->
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$csrf              = Yii::$app->request->getCsrfToken();
$nonAjaxRequestFav = <<<JS

/**
 * Report data export
 */
$('.box-tools a.btn-export').click(function() {
    var href = $(this).attr('href');
    var data = [
        {name: '_csrf',       value: "$csrf"}
    ];
    submit(href, 'POST', data);
    return false;
});
JS;

$this->registerJs($nonAjaxRequestFav);
