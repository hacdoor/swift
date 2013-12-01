<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'group-_form-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">

        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'slug', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'slug', array('class' => 'form-control disabled', 'readonly' => 'readonly', 'placeholder' => 'automatic')); ?>
                    <?php echo $form->error($model, 'slug'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'description', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textarea($model, 'description', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>

            <hr>

            <!-- Permissions -->

            <div class="form-group permission-list">
                <label class="col-md-2 control-label">Permissions</label>
                <div class="col-md-10">
                    <?php
                    $i = -1;
                    foreach ($permissions as $k => $v):
                        ?>
                        <div class="permission-list-item clearfix">
                            <?php if ($i % 4 < 3 && $i != -1): ?></div><?php endif; ?>
                        <div class="row"><div class="col-md-12"><strong class="permission-group"><?php echo $k; ?></strong></div></div>
                        <?php
                        $i = -1;
                        foreach ($v as $p):
                            $i++;
                            $wrapStart = false;
                            $wrapEnd = false;
                            if ($i % 4 == 0)
                                $wrapStart = true;
                            if ($i % 4 == 3)
                                $wrapEnd = true;

                            $checked = '';
                            foreach ($model->groupPermissions as $mg) {
                                if ($p->id == $mg->permission_id)
                                    $checked = 'checked="checked"';
                            }
                            ?>
                            <?php if ($wrapStart): ?><div class="row"><?php endif; ?>
                                <div class="col-md-3">
                                    <label class="checkbox-inline <?php if ($p->id == 1): ?>system-root-permission<?php endif; ?> <?php if ($p->description): ?>bootip<?php endif; ?>" for="permission-<?php echo $p->id; ?>" <?php if ($p->description): ?>title="<?php echo Yii::app()->util->purify($p->description); ?>"<?php endif; ?>>
                                        <input type="checkbox" class="checkbox <?php if ($p->id == 1): ?>system-root<?php endif; ?>" value="<?php echo $p->id; ?>" name="Group[permissions][]" id="permission-<?php echo $p->id; ?>" <?php echo $checked; ?>>
                                        <?php echo Yii::app()->util->purify($p->name); ?>
                                    </label>
                                </div>
                                <?php if ($wrapEnd): ?></div><?php endif; ?>
                        <?php endforeach; ?>
                        <div class="clear"></div>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
</fieldset>

</div>

<div class="col-md-12 clear form-actions">
    <hr>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/group" class="btn btn-lg btn-default">Cancel</a>
    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div>