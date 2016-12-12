<?php

use yii\helpers\Html;
$this->title = "创建报表";
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

        <?=
        $this->render('_editor', [
            'sqlForm'           => $sqlForm,
            'dbDropdownOptions' => $dbDropdownOptions,
        ])
        ?>

        <?php if (!empty($results) || $exception) : ?>
            <div class="box box-primary">
                <?php if (count($results) > 0) : ?>
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php /* if ($queryObj->bookmarked) : ?>
                                <i class="fa fa-star text-danger"></i><?= Html::encode($queryObj->name) ?>
                            <?php else: */?>
                                查询结果
                            <?php // endif; ?>
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a href="" target="_blank" class="btn btn-default">
                                    <i class="fa fa-download text-danger"></i>
                                    导出
                                </a>
                                    <a id="fav" class="btn btn-default">
                                        <i class="fa fa-edit text-danger"></i>
                                        收藏结果
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

$("#fav").click(function() {
    var name = prompt("请输入收藏名称", "");
    if (name && name.replace(/^\s*/, "").replace(/\s*$/, "").length > 0) {
        var data = [
            {name: 'id',    value: ''},
            {name: 'name',  value: name},
            {name: 'sql',   value: editor_sqleditor.getDoc().getValue()},
            {name: 'c',     value: $("ul.connector-dropdown > li.active > a").data('value')},
            {name: '_csrf', value: "$csrf"}
        ];
        submit('/query/fav', 'POST', data);
    }
    return false;
});
JS;

$this->registerJs($nonAjaxRequestFav);
