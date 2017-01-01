<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '报表: ' . Html::encode($report->name);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="box box-info collapsed-box">
            <div class="box-header">
                <h3 class="box-title">详细信息</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body box-comments">
                <div class="box-comment">
                    <div class="comment-text">
                        <span class="username">
                            作者: <?= Html::encode($report->user->username)?>
                            <span class="text-muted pull-right">创建时间: <?= Html::encode($report->created_at)?></span>
                        </span><!-- /.username -->
                        <?= Html::encode($report->description)?>
                        <p>最后更新时间: <?=Html::encode($report->updated_at)?></p>
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
                            <i class="fa fa-list-alt text-info"></i> 查询结果
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a class="btn btn-default btn-export" href="<?= Url::to(['/report/export-by-id', 'id' => $report->id])?>" target="_blank">
                                    <i class="fa fa-download text-danger"></i>
                                    导出
                                </a>
                                <a class="btn btn-default" href="<?= Url::toRoute(['/report/update', 'id' => $report->id])?>">
                                    <i class="fa fa-edit text-danger"></i>
                                    编辑
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

/**
 * 报表导出
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
