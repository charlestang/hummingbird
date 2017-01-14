<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title      = Yii::t('app', 'Edit Report');
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <?=
        $this->render('_editor', [
            'sqlForm'           => $sqlForm,
            'dbDropdownOptions' => $dbDropdownOptions,
        ])
        ?>
        <div class="box box-info">
            <div class="box-header"></div>
            <div class="box-body">
                <form role="form" class="report-update-form" action="<?= Url::toRoute(['report/save', 'id' => $report->id])?>">
                    <div class="form-group">
                        <label><?= Yii::t('app', 'Report name: ')?></label>
                        <input type="text" class="form-control report-name" value="<?=Html::encode($report->name)?>" />
                    </div> 
                    <div class="form-group">
                        <label><?= Yii::t('app', 'Description: ')?></label>
                        <textarea class="form-control report-description"><?=Html::encode($report->description)?></textarea>
                    </div> 
                </form>
            </div>
            <div class="box-footer">
                <?=
                Button::widget([
                    'label' => Yii::t('app', 'Save'),
                    'options' =>[
                        'class' => 'btn-success report-save',
                    ]
                ]);
                ?>
            </div>
        </div>

        <?php if (!empty($results) || $exception) : ?>
            <div class="box box-info">
                <?php if (count($results) > 0) : ?>
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-list-alt text-info"></i><?= Yii::t('app', 'Query results: ')?>
                        </h3>
                        <?php if (!$exception): ?>
                            <div class="box-tools pull-right">
                                <a href="javascript:;" target="_blank" class="btn btn-default">
                                    <i class="fa fa-download text-danger"></i>
                                    <?= Yii::t('app', 'Export')?>
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

$("button.report-save").click(function() {
    var name = $("form.report-update-form .report-name").val();
    var description = $("form.report-update-form .report-description").val();
    if (name && name.replace(/^\s*/, "").replace(/\s*$/, "").length > 0) {
        var data = [
            {name: 'Report[name]',        value: name},
            {name: 'Report[description]', value: description},
            {name: 'Report[sql]',         value: editor_sqleditor.getDoc().getValue()},
            {name: 'Report[database_id]', value: $("ul.connector-dropdown > li.active > a").data('value')},
            {name: '_csrf', value: "$csrf"}
        ];
        submit($("form.report-update-form").attr("action"), 'POST', data);
    }
    return false;
});
JS;

$this->registerJs($nonAjaxRequestFav);
