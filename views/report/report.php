<?php
$this->title = '报表: ' . yii\helpers\Html::encode($report->name);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

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
                                <a href="javascript:;" target="_blank" class="btn btn-default">
                                    <i class="fa fa-download text-danger"></i>
                                    导出
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