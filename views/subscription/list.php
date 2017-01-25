<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'My Favorites');
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
                    'summary'      => '',
                    'tableOptions' => [
                        'class' => 'table table-hover table-striped table-bordered m-b-0'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'report.name',
                        'report.user.username:text:' . Yii::t('app', 'Creator'),
                        'created_at:datetime',
                        [
                            'class'    => 'yii\grid\ActionColumn',
                            'template' => '{view} {delete}',
                            'buttons'  => [
                                'view' => function ($url, $model, $key) {
                                    $options = [
                                        'title' => Yii::t('yii', 'View'),
                                        'aria-label' => Yii::t('yii', 'View'),
                                        'data-pjax' => '0',
                                    ];
                                    $url = Url::to(['report/view', 'id' => $model->report_id]);
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                }
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