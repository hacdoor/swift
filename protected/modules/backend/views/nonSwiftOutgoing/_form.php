<?php
/* @var $this SwiftController */
/* @var $model Swift */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'swiftOutgoing-form',
        'enableAjaxValidation' => FALSE,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
    ));
    ?>


    <div class="col-md-12">

        <fieldset>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'jenisLaporan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'jenisLaporan', Yii::app()->util->getKodeStandar(array('modul' => 'jenisLaporan', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'jenisLaporan'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'localId', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'localId', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'localId'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'noLtdlnKoreksi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'noLtdlnKoreksi', array('class' => 'form-control', 'readonly' => 'readonly', 'value' => isset($number) ? $number : $model->noLtdln)); ?>
                    <?php echo $form->error($model, 'noLtdlnKoreksi'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'tglLaporan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'tglLaporan', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                    <?php echo $form->error($model, 'tglLaporan'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'namaPjk', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'namaPjk', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaPjk'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'namaPejabatPjk', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'namaPejabatPjk', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaPejabatPjk'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'keterlibatanBeneficialOwner', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'keterlibatanBeneficialOwner', $model->getKeterlibatanBeneficialOwnerOptions(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'keterlibatanBeneficialOwner'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $('#Swift_jenisLaporan').on('change', function() {
        if ($(this).val() == 1 || $(this).val() == '') {
            $("#Swift_noLtdlnKoreksi").attr('readonly', 'readonly');
        } else {
            $("#Swift_noLtdlnKoreksi").removeAttr('readonly');
        }
    });
</script>