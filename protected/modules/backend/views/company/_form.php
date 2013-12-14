<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'company-form',
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
                <?php echo $form->labelEx($model, 'namaPjk', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-6">
                    <?php echo $form->textField($model, 'namaPjk', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaPjk'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'namaPejabatPjk', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'namaPejabatPjk', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaPejabatPjk'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'trxSource', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'trxSource', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'trxSource'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'kycSource', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'kycSource', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'kycSource'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'personSource', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'personSource', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'personSource'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->vars['backendUrl']; ?>company" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>