<?php

use yii\web\View;
/* @var $this View */
?>
<textarea 
    id="<?=$this->context->editorId?>" 
    name="<?=$this->context->editorName?>"><?=$this->context->defaultContent?></textarea>