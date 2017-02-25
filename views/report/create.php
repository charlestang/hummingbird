<?php $this->title = Yii::t('app', 'Create Report'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <?= $this->render('_editor', [
            'sqlForm'           => $sqlForm,
            'dbDropdownOptions' => $dbDropdownOptions,
            'scenario'          => 'create',
        ])?>
    </div>
</div>
