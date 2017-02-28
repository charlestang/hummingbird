<?php
use app\widgets\datetimepicker\DateTimePicker;
use kartik\date\DatePicker;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\SqlForm;
use app\widgets\codemirror\CodeMirror;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;
use yii\widgets\ActiveForm;

/* @var $sqlForm SqlForm */
$this->title = Yii::t('app', 'Create Report');
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box">
            <div class="box-body">
                <?php
                $form    = ActiveForm::begin([
                      'action'  => '',
                      'method'  => 'post',
                      'options' => [
                          'id' => 'editorpanel'
                      ]
                  ])
                ?>
                <?=
                CodeMirror::widget([
                    'editorId'       => 'sqleditor',
                    'editorName'     => 'sql',
                    'defaultContent' => $sqlForm->sql,
                ])
                ?>
                <input type="hidden" name="database_id" value="<?= Html::encode($sqlForm->database_id) ?>"/>
                <div class="row no-padding m-b-0 m-t-1">
                    <div class="col-lg-12 col-sm-12">
                        <?php
                        if ($sqlForm->parameterized):
                            $parameters = $sqlForm->getParameters();
                            foreach ($parameters as $key => $p) {
                                switch ($p['type']) {
                                    case 'date':
                                        echo '<div class="form-group">';
                                        echo '<label for="',$key,'">', $key, '</label>';
                                        echo DatePicker::widget([
                                            'name' => $key,
                                            'pickerButton' => '<div class="input-group-addon kv-date-calendar"><i class="fa fa-calendar"></i></div>',
                                            'layout' => '{picker}{input}',
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'value' => $p['default'],
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]);
                                        echo '</div>';
                                        break;
                                    case 'datetime':
                                        echo DateTimePicker::widget([
                                            'name' => $key,
                                            'value' => $p['default'],
                                            'label' => $key,
                                        ]);
                                        break;
                                    case 'string':
                                        ?>
                                        <div class="form-group">
                                            <label><?= $key?></label>
                                            <input type="text" class="form-control" value="<?= $p['default']?>">
                                        </div>
                                        <?php
                                        break;
                                    default:
                                        break;
                                }
                            }
                        endif;
                        $options = [
                            'split'    => false,
                            'options'  => [
                                'class' => 'btn-success',
                            ],
                            'dropdown' => [
                                'options' => [
                                    'id'    => 'connector_list',
                                    'class' => 'connector-dropdown',
                                ],
                                'items'   => [],
                            ],
                        ];
                        foreach ($dbDropdownOptions as $dbId => $dbAlias) {
                            $options['dropdown']['items'][] = [
                                'label'       => $dbAlias,
                                'url'         => '#',
                                'linkOptions' => [
                                    'data-value' => $dbId,
                                ],
                                'options'     => [
                                    'class' => $sqlForm->database_id == $dbId ? 'active' : '',
                                ],
                            ];
                            if ($sqlForm->database_id == $dbId) {
                                $options['label'] = $dbAlias;
                            }
                        }
                        echo ButtonGroup::widget([
                            'buttons' => [
                                Button::widget([
                                    'label'   => Yii::t('app', 'Query'),
                                    'options' => [
                                        'class' => 'btn-success'
                                    ]
                                ]),
                                ButtonDropdown::widget($options),
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?php $form->end() ?>
            </div>
        </div>
        <div class="box box-info collapsed-box">
            <div class="box-header">
                <h3 class="box-title">
                    <i class="fa fa-list-alt text-primary"></i>
                    <?= Yii::t('app', 'Time spent: {time_spent,plural,=1{ # second.} other{ # seconds.}}', [
                    'time_spent' => $sqlForm->getTimeSpent()
                    ])?> |
                    <?= Yii::t('app', 'Formatted:')?>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <pre class="sql-syntax-analyze"><?=$sqlForm->getBeautifiedVersion()?></pre>
            </div>
            <div class="box-footer">
                <p><?= Yii::t('app', 'Time spent: {time_spent,plural,=1{ # second.} other{ # seconds.}}', [
                    'time_spent' => $sqlForm->getTimeSpent()
                ])?></p>
            </div>
        </div>

        <div class="box box-primary">
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
                <?php
                if (count($results) > 0) :
                    echo $this->render('_results', [ 'results' => $results]);
                else:
                    echo '<p>' . Yii::t('app', 'Empty set.') . '</p>';
                endif;
                ?>
            </div>
            <!-- /.box-body -->

            <?php if ($exception) : ?>
            <!-- .box-footer -->
            <div class="box-footer">
                <div class="grid full">
                    <pre class="text-danger"><?= Html::encode($exception) ?></pre>
                </div>
            </div>
            <!-- /.box-footer -->
            <?php endif; ?>
        </div>

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

$csrf              = Yii::$app->request->getCsrfToken();
$nonAjaxRequestFav = <<<JS
CodeMirror.commands.save = function(){
    $('#editorpanel').submit();
};
$('#connector_list a').click(function() {
    var form =$('#editorpanel');
    var connector = $(this).data('value');
    $('input[name=database_id]', form).val(connector);
    //todo: I add this tricky code because I used Yii ActiveForm
    //      but in an improper way, which cause the form cannot be submitted.
    form.unbind("submit").submit();
    return false;
});

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
