<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addNasabahKorporasiLn-form',
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
                <?php echo $form->labelEx($nasabahKorporasiLn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'noRekening'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'namaKorporasi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'namaKorporasi', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'namaKorporasi'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Alamat Sesuai Voucher</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'alamat'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'negaraBagianKota'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'idNegara', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahKorporasiLn, 'idNegara', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control chzn-select')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'idNegara'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'negaraLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'negaraLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'negaraLain'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiLn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiLn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiLn, 'noTelp'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nasabahKorporasiLn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>

<script>
    $('#NasabahKorporasiLn_idNegara').on('change', function() {
        if ($(this).val() == 999) {
            $("#NasabahKorporasiLn_negaraLain").removeAttr('readonly');
        } else {
            $("#NasabahKorporasiLn_negaraLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahKorporasiLn_bentukBadan').on('change', function() {
        if ($(this).val() == 9) {
            $("#NasabahKorporasiLn_bentukBadanLain").removeAttr('readonly');
        } else {
            $("#NasabahKorporasiLn_bentukBadanLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahKorporasiLn_bidangUsaha').on('change', function() {
        if ($(this).val() == 22) {
            $("#NasabahKorporasiLn_bidangUsahaLain").removeAttr('readonly');
        } else {
            $("#NasabahKorporasiLn_bidangUsahaLain").attr('readonly', 'readonly');
        }
    });
</script>