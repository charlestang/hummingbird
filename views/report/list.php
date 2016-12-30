<?php

use app\models\Subscription;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '报表一览';
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
                        'user.username:text:创建人',
                        'name',
                        'description',
                        'created_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=> '{view} {update} {delete} {favorite}',
                            'buttons' => [
                                'favorite' => function ($url, $model, $key) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Favorite'),
                                        'aria-label' => Yii::t('yii', 'Favorite'),
                                        'data-pjax' => '0',
                                    ];
                                    $url = Url::toRoute(['/subscription/toggle', 'report_id' => (string) $key]);
                                    if (Subscription::isSubscribed(Yii::$app->user->id, $key)) {
                                        $class = 'glyphicon-star';
                                    } else {
                                        $class = 'glyphicon-star-empty';
                                    }
                                    return Html::a("<span class=\"glyphicon $class\"></span>", $url, $options); 
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