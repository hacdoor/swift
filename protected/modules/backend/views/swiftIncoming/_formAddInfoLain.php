<?php
/* @var $this SwiftController */
/* @var $model Swift */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addInfoLain-form',
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
                <?php echo $form->labelEx($infoLain, 'infSendersCorrespondent', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'infSendersCorrespondent', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'infSendersCorrespondent'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'infReceiverCorrespondent', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'infReceiverCorrespondent', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'infReceiverCorrespondent'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'infThirdReimbursementInstitution', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'infThirdReimbursementInstitution', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'infThirdReimbursementInstitution'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'infIntermediaryInstitution', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'infIntermediaryInstitution', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'infIntermediaryInstitution'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'infBeneficiaryCustomerAccountInstitution', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'infBeneficiaryCustomerAccountInstitution', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'infBeneficiaryCustomerAccountInstitution'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'remittanceInformation', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'remittanceInformation', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'remittanceInformation'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'senderToReceiverInformation', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'senderToReceiverInformation', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'senderToReceiverInformation'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'regulatoryReporting', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'regulatoryReporting', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'regulatoryReporting'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($infoLain, 'envelopeContents', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($infoLain, 'envelopeContents', array('class' => 'form-control')); ?>
                    <?php echo $form->error($infoLain, 'envelopeContents'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($infoLain->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
