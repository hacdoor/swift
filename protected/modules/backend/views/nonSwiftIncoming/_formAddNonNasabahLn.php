<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addNonNasabahLn-form',
        'enableAjaxValidation' => FALSE,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">
        <fieldset class="well">
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'noRekening'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'namaLengkap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'namaLengkap'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                    <?php echo $form->error($nonNasabahLn, 'tglLahir'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Alamat Sesuai Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'alamat'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'noTelp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'negaraBagianKota'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'idNegara', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nonNasabahLn, 'idNegara', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahLn, 'idNegara'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahLn, 'negaraLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahLn, 'negaraLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nonNasabahLn, 'negaraLain'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nonNasabahLn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>

<script>
    $('#NonNasabahLn_idNegara').on('change', function() {
        if ($(this).val() == 999) {
            $("#NonNasabahLn_negaraLain").removeAttr('readonly');
        } else {
            $("#NonNasabahLn_negaraLain").attr('readonly', 'readonly');
        }
    });
</script>