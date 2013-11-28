<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-_form-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">

        <fieldset>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'kode', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'kode', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'kode'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'nama', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-6">
                    <?php echo $form->textField($model, 'nama', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'nama'); ?>
                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/negara" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>