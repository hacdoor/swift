<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addNasabahPeroranganLn-form',
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
                <?php echo $form->labelEx($nasabahPeroranganLn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'noRekening'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'namaLengkap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'namaLengkap'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'tglLahir'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Kewarganegaraan</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'wargaNegara', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php
                    echo $form->dropDownList($nasabahPeroranganLn, 'wargaNegara', Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => 'all&blank')), array(
                        'class' => 'form-control',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNasabahPeroranganLnNegaraKewarganegaraan'),
                            'update' => '#NasabahPeroranganLn_idNegaraKewarganegaraan',
                            )));
                    ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'wargaNegara'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'idNegaraKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganLn, 'idNegaraKewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'idNegaraKewarganegaraan'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'negaraLainKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'negaraLainKewarganegaraan', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'negaraLainKewarganegaraan'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Alamat Sesuai Voucher</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'alamat'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'negaraBagianKota'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'idNegaraVoucher', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganLn, 'idNegaraVoucher', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'idNegaraVoucher'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'negaraLainVoucher', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'negaraLainVoucher', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'negaraLainVoucher'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'noTelp'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'ktp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'ktp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'ktp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'sim', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'sim', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'sim'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'passport', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'passport', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'passport'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'kimsKitasKitap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'kimsKitasKitap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'kimsKitasKitap'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'npwp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'npwp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'npwp'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Bukti Lain</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'jenisBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'jenisBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'jenisBuktiLain'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganLn, 'noBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganLn, 'noBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganLn, 'noBuktiLain'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nasabahPeroranganLn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>

<script>
    $('#NasabahPeroranganLn_idNegaraKewarganegaraan').on('change', function() {
        if ($(this).val() == 999) {
            $("#NasabahPeroranganLn_negaraLainKewarganegaraan").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganLn_negaraLainKewarganegaraan").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganLn_idNegaraVoucher').on('change', function() {
        if ($(this).val() == 999) {
            $("#NasabahPeroranganLn_negaraLainVoucher").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganLn_negaraLainVoucher").attr('readonly', 'readonly');
        }
    });
</script>