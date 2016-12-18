<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "创建报表";
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
            <div class="box box-primary">
                <?php if (count($results) > 0) : ?>
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-list-alt text-primary"></i> 查询结果
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a href="" target="_blank" class="btn btn-default">
                                    <i class="fa fa-download text-danger"></i>
                                    导出
                                </a>
                                <a class="btn btn-default" data-toggle="modal" data-target="#reportSave">
                                    <i class="fa fa-edit text-danger"></i>
                                    保存成报表 
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
    'header'       => '<h4 class="modal-title">保存报表</h4>',
    'toggleButton' => false,
    'footer'       => '<button type="button" class="btn pull-left" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-success report-save">确认保存</button>',
]);
?>
<form action="<?= Url::to('/report/save') ?>">
    <div class="form-group">
        <label for="report-name" class="control-label">报表名称: </label>
        <input type="text" class="form-control" id="reportName">
    </div>
    <div class="form-group">
        <label for="report-description" class="control-label">内容描述: </label>
        <textarea class="form-control" id="reportDescription"></textarea>
    </div>
</form>
<?php
Modal::end();

$csrf              = \Yii::$app->request->getCsrfToken();
$nonAjaxRequestFav = <<<JS
var submit = function (action, method, values) {
    var form = $('<form/>', {
        action: action,
        method: method
    });
    $.each(values, function() {
        form.append($('<input/>', {
            type: 'hidden',
            name: this.name,
            value: this.value
        }));
    });
    form.appendTo('body').submit();
};

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
