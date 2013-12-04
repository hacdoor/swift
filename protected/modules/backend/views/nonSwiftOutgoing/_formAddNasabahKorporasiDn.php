<?php
/* @var $this SwiftController */
/* @var $nasabahKorporasiLn Swift */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addNasabahKorporasiDn-form',
        'enableAjaxValidation' => FALSE,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
    ));
    ?>


    <div class="col-md-12">
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'noRekening'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'namaKorporasi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'namaKorporasi', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'namaKorporasi'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'bentukBadan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahKorporasiDn, 'bentukBadan', Yii::app()->util->getKodeStandar(array('modul' => 'bentukBadanUsaha', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'bentukBadan'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'bentukBadanLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'bentukBadanLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'bentukBadanLain'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'bidangUsaha', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahKorporasiDn, 'bidangUsaha', Yii::app()->util->getKodeStandar(array('modul' => 'bidangUsaha', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'bidangUsaha'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'bidangUsahaLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'bidangUsahaLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'bidangUsahaLain'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset><legend>Alamat Sesuai Voucher</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'alamat'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'idPropinsi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php
                    echo $form->dropDownList($nasabahKorporasiDn, 'idPropinsi', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array(
                        'class' => 'form-control',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNasabahKorporasiDnPropinsi'),
                            'update' => '#NasabahKorporasiDn_idKabKota',
                    )));
                    ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'idPropinsi'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'propinsiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'propinsiLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'propinsiLain'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'idKabKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahKorporasiDn, 'idKabKota', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'idKabKota'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'kabKotaLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'kabKotaLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'kabKotaLain'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahKorporasiDn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahKorporasiDn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahKorporasiDn, 'noTelp'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nasabahKorporasiDn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $('#NasabahKorporasiDn_bentukBadan').on('change', function() {
        if ($(this).val() == 9) {
            $("#NasabahKorporasiDn_bentukBadanLain").removeAttr('readonly');
        } else {
            $("#NasabahKorporasiDn_bentukBadanLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahKorporasiDn_bidangUsaha').on('change', function() {
        if ($(this).val() == 22) {
            $("#NasabahKorporasiDn_bidangUsahaLain").removeAttr('readonly');
        } else {
    $("#NasabahKorporasiDn_bidangUsahaLain").attr('readonly', 'readonly');
        }
    });
            $('#NasabahKorporasiDn_idPropinsi').on('change', function() {
        if ($(this).val() == 96) {
            $("#NasabahKorporasiDn_propinsiLain").removeAttr('readonly');
        } else {
    $("#NasabahKorporasiDn_propinsiLain").attr('readonly', 'readonly');
        }
    });
            $('#NasabahKorporasiDn_idKabKota').on('change', function() {
        if ($(this).val() == 440) {
            $("#NasabahKorporasiDn_kabKotaLain").removeAttr('readonly');
        } else {
    $("#NasabahKorporasiDn_kabKotaLain").attr('readonly', 'readonly');
        }
    });
</script>