<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'kabupaten-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">
        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'nama', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-4">
                    <?php echo $form->textField($model, 'nama', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'nama'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php $listData = Propinsi::model()->findAll(array('order' => 'nama ASC')); ?>
                <?php echo $form->labelEx($model, 'propinsi_id', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-4">
                    <?php echo $form->dropDownList($model, 'propinsi_id', CHtml::listData($listData, 'id', 'nama'), array('class' => 'form-control chzn-select', 'empty' => '- Pilih Propinsi')); ?>
                    <?php echo $form->error($model, 'propinsi_id'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->vars['backendUrl']; ?>kabupaten" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>