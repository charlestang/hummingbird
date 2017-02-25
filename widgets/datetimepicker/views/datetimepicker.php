<div class="form-group">
    <?php if ($this->context->label) : ?>
        <label><?= $this->context->label ?></label>
    <?php endif;?>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" 
               id="<?= $this->context->id?>" 
               name="<?= $this->context->name?>">
    </div>
    <!-- /.input group -->
</div>