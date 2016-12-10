<?php

use app\widgets\codemirror\CodeMirror;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $queryObj Queries */
?>
<div class="box box-primary">
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
                <div class="input-group">
                    <?php
                    $options = [
                        'label'            => '查询',
                        'split'            => true,
                        'options'          => [
                            'class' => 'btn-success',
                        ],
                        'containerOptions' => [
                            'class' => ['widget' => 'input-group-btn'],
                        ],
                        'dropdown'         => [
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
                    }
                    echo ButtonDropdown::widget($options);
                    ?>
                    <span class="input-group-addon">收藏标题: </span>
                    <input type="text" class="form-control" value="" name="name">
                    <div class="input-group-btn">
                      <button id="btn_update" type="submit" class="btn btn-primary">保存新结果</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $form->end() ?>
    </div>
</div>
<?php
$editorBehaviour = <<<JS
    CodeMirror.commands.save = function(){
        $('#editorpanel').submit();
    }
    $('#btn_update').click(function() {
        $('#editorpanel').append('<input type="hidden" name="update" value="1"/>').submit();
        return false;
    });
    $('#connector_list a').click(function() {
        var \$form =$('#editorpanel');
        var connector = $(this).data('value');
        $('input[name=connector]', \$form).val(connector);
        \$form.submit();
    });
JS;
$this->registerJS($editorBehaviour);
