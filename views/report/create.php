<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Create Report');
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

        <?=
        $this->render('_editor', [
            'sqlForm'           => $sqlForm,
            'dbDropdownOptions' => $dbDropdownOptions,
            'scenario'          => 'create',
        ])
        ?>

        <?php if (!empty($results) || $exception) : ?>
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-list-alt text-primary"></i> <?= Yii::t('app', 'Formatted SQL')?> 
                    </h3>
                </div>
                <div class="box-body">
                    <pre class="sql-syntax-analyze"><?=$sqlForm->getBeautifiedVersion()?></pre>
                </div>
                <div class="box-footer">
                    <p><?= Yii::t('app', 'Time spent: {time_spent,plural,=1{ # second.} other{ # seconds.}}', [
                        'time_spent' => $sqlForm->time_spent
                    ])?></p>
                </div>
            </div>
            <div class="box box-primary">
                <?php if (count($results) > 0) : ?>
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-list-alt text-primary"></i> <?= Yii::t('app', 'Query Result')?>
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a class="btn btn-default btn-export" href="<?=Url::toRoute(['/report/export-query'])?>">
                                    <i class="fa fa-download text-danger"></i>
                                    <?= Yii::t('app', 'Export')?>
                                </a>
                                <a class="btn btn-default" data-toggle="modal" data-target="#reportSave">
                                    <i class="fa fa-edit text-danger"></i>
                                    <?= Yii::t('app', 'Save Report')?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- .box-body -->
                    <div class="box-body p-b-0 p-t-0">
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
/**
 * 报表保存的对话框
 */
Modal::begin([
    'options'      => ['class' => 'modal', 'id' => 'reportSave'],
    'header'       => '<h4 class="modal-title">' . Yii::t('app', 'Save Report') . '</h4>',
    'toggleButton' => false,
    'footer'       => '<button type="button" class="btn pull-left" data-dismiss="modal">'
        . Yii::t('app', 'Cancel') . '</button>
                <button type="button" class="btn btn-success report-save">'
        . Yii::t('app', 'Confirm') . '</button>',
]);
?>
<form action="<?= Url::to('/report/save') ?>">
    <div class="form-group">
        <label for="report-name" class="control-label"><?= Yii::t('app', 'Report name: ')?></label>
        <input type="text" class="form-control" id="reportName">
    </div>
    <div class="form-group">
        <label for="report-description" class="control-label"><?= Yii::t('app', 'Description: ')?></label>
        <textarea class="form-control" id="reportDescription"></textarea>
    </div>
</form>
<?php
Modal::end();

$csrf              = \Yii::$app->request->getCsrfToken();
$nonAjaxRequestFav = <<<JS

/**
 * Report export
 */
$('.box-tools a.btn-export').click(function() {
    var href = $(this).attr('href');
    var data = [
        {name: 'sql',         value: editor_sqleditor.getDoc().getValue()}, 
        {name: 'database_id', value: $("ul.connector-dropdown > li.active > a").data('value')},
        {name: '_csrf',       value: "$csrf"}
    ];
    submit(href, 'POST', data);
    return false;
});

$("#reportSave button.report-save").click(function() {
    var name = $("#reportName").val();
    var description = $("#reportDescription").val();
    if (name && name.replace(/^\s*/, "").replace(/\s*$/, "").length > 0) {
        var data = [
            {name: 'Report[name]',        value: name},
            {name: 'Report[description]', value: description},
            {name: 'Report[sql]',         value: editor_sqleditor.getDoc().getValue()},
            {name: 'Report[database_id]', value: $("ul.connector-dropdown > li.active > a").data('value')},
            {name: '_csrf', value: "$csrf"}
        ];
        submit($("#reportSave form").attr("action"), 'POST', data);
    }
    return false;
});
JS;

$this->registerJs($nonAjaxRequestFav);
