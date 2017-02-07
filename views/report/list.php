<?php

use app\models\SqlForm;
use app\models\Subscription;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Report List');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => '',
                    'tableOptions' => ['class' => 'table table-hover table-striped table-bordered m-b-0'],
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'user.username:text:' . Yii::t('app', 'Creator'),
                        'name',
                        'description',
                        'created_at:datetime',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=> '{detail} {view} {update} {delete} {favorite}',
                            'buttons' => [
                                'favorite' => function ($url, $model, $key) {
                                    $options = [
                                        'title' => Yii::t('app', 'Favorite'),
                                        'aria-label' => Yii::t('app', 'Favorite'),
                                        'data-pjax' => '0',
                                    ];
                                    $url = Url::toRoute(['/subscription/toggle', 'report_id' => (string) $key]);
                                    if (Subscription::isSubscribed(Yii::$app->user->id, $key)) {
                                        $class = 'glyphicon-star';
                                    } else {
                                        $class = 'glyphicon-star-empty';
                                    }
                                    return Html::a("<span class=\"glyphicon $class\"></span>", $url, $options); 
                                },
                                'detail' => function ($url, $model, $key) {
                                    $options = [
                                        'title' => Yii::t('app', 'Detail'),
                                        'aria-label' => Yii::t('app', 'Detail'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#reportSql',
                                        'data-report' => $key,
                                    ];
                                    $url = 'javascript:;';
                                    $sql = new SqlForm();
                                    $sql->sql = $model->sql;
                                    echo Html::tag('div', Html::tag('pre', $sql->getBeautifiedVersion()), [
                                        'class' => 'hide',
                                        'id' => 'report-id-' . $key,
                                    ]);
                                    return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, $options); 
                                },
                            ],
                        ],
                    ],
                ]);
                ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<?php
/**
 * 显示报表SQL内容的对话框
 */
Modal::begin([
    'options'      => ['class' => 'modal', 'id' => 'reportSql'],
    'header'       => '<h4 class="modal-title">' . Yii::t('app', 'Detail') . '</h4>',
    'toggleButton' => false,
    'footer'       => '<button type="button" class="btn " data-dismiss="modal">' . Yii::t('app', 'Cancel') . '</button>',
]);
?>
<pre class="sql-syntax-analyze"></pre>
<?php
Modal::end();

$reportSqlContent = <<<JS
$('#reportSql').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var reportId = button.data('report');
  var content = $('div#report-id-'+reportId+' pre').html();
  var modal = $(this);
  modal.find('.sql-syntax-analyze').html(content);
})
JS;

$this->registerJs($reportSqlContent);