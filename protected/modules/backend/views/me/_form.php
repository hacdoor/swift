<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-_form-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-9">

        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'realname', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'realname', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'realname'); ?>
                </div>
            </div>

        </fieldset>

    </div>

    <div class="col-md-3">
        <hr class="visible-xs">

        <div class="panel panel-default panel-backend" id="panel-password">
            <div class="panel-heading">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#panel-password" href="#panel-password-body"><span class="icon icon-lock"></span> Password</a>
            </div>
            <div class="panel-body panel-collapse collapse" id="panel-password-body">
                <fieldset class="form">
                    <?php if ($model->id): ?>
                        <label for="toggle-password" class="checkbox-inline">
                            <input type="checkbox" name="Admin[change_password]" id="toggle-password" value="1" class="checkbox">
                            Change password
                        </label>
                    <?php endif; ?>

                    <div id="form-password">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'value' => '')); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>


                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'confirm_password', array('class' => 'control-label')); ?>
                            <?php echo $form->passwordField($model, 'confirm_password', array('class' => 'form-control', 'value' => '')); ?>
                            <?php echo $form->error($model, 'confirm_password'); ?>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>

    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->