<?php
/* @var $this SwiftController */
/* @var $nasabahPeroranganDn Swift */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addNasabahPeroranganDn-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
    ));
    ?>

    <div class="row">
        <div class="col-md-12">

            <fieldset class="well">
                <div class="form-group">
                    <?php echo $form->labelEx($nasabahPeroranganDn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($nasabahPeroranganDn, 'noRekening', array('class' => 'form-control')); ?>
                        <?php echo $form->error($nasabahPeroranganDn, 'noRekening'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($nasabahPeroranganDn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($nasabahPeroranganDn, 'namaLengkap', array('class' => 'form-control')); ?>
                        <?php echo $form->error($nasabahPeroranganDn, 'namaLengkap'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($nasabahPeroranganDn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($nasabahPeroranganDn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                        <?php echo $form->error($nasabahPeroranganDn, 'tglLahir'); ?>
                    </div>
                </div>
        </div>
        </fieldset>
        <fieldset class="well"><legend>Kewarganaegaraan</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'wargaNegara', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php
                    echo $form->dropDownList($nasabahPeroranganDn, 'wargaNegara', Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => 'all&blank')), array(
                        'class' => 'form-control  chzn-select',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNasabahPeroranganDnNegaraKewarganegaraan'),
                            'update' => '#NasabahPeroranganDn_idNegaraKewarganegaraan',
                    )));
                    ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'wargaNegara'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'idNegaraKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganDn, 'idNegaraKewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'idNegaraKewarganegaraan'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'negaraLainKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'negaraLainKewarganegaraan', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'negaraLainKewarganegaraan'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'pekerjaan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganDn, 'pekerjaan', Yii::app()->util->getKodeStandar(array('modul' => 'pekerjaan', 'data' => 'all&blank')), array('class' => 'form-control chzn-select')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'pekerjaan'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'pekerjaanLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'pekerjaanLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'pekerjaanLain'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset class="well"><legend>Alamat Domisili</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'alamatDomisili', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'alamatDomisili', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'alamatDomisili'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'idPropinsiDomisili', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php
                    echo $form->dropDownList($nasabahPeroranganDn, 'idPropinsiDomisili', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array(
                        'class' => 'form-control  chzn-select',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNasabahPeroranganDnDomisili'),
                            'update' => '#NasabahPeroranganDn_idKabKotaDomisili',
                    )));
                    ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'idPropinsiDomisili'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'propinsiLainDomisili', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'propinsiLainDomisili', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'propinsiLainDomisili'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'idKabKotaDomisili', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganDn, 'idKabKotaDomisili', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'idKabKotaDomisili'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'kabKotaLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'kabKotaLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'kabKotaLain'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Alamat Sesuai Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'alamatIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'alamatIdentitas', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'alamatIdentitas'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'idPropinsiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php
                    echo $form->dropDownList($nasabahPeroranganDn, 'idPropinsiIdentitas', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array(
                        'class' => 'form-control chzn-select',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNasabahPeroranganDnIdentitas'),
                            'update' => '#NasabahPeroranganDn_idKabKotaIdentitas',
                    )));
                    ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'idPropinsiIdentitas'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'propinsiLainIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'propinsiLainIdentitas', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'propinsiLainIdentitas'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'idKabKotaIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nasabahPeroranganDn, 'idKabKotaIdentitas', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'idKabKotaIdentitas'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'kabKotaLainIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'kabKotaLainIdentitas', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'kabKotaLainIdentitas'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'noTelp'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'ktp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'ktp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'ktp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'sim', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'sim', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'sim'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'passport', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'passport', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'passport'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'kimsKitasKitap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'kimsKitasKitap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'kimsKitasKitap'); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'npwp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'npwp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'npwp'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset class="well">
            <legend>Bukti Lain</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'jenisBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'jenisBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'jenisBuktiLain'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'noBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'noBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'noBuktiLain'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset class="well">
            <legend>Nilai Transaksi</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nasabahPeroranganDn, 'nilaiTransaksiDalamRupiah', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nasabahPeroranganDn, 'nilaiTransaksiDalamRupiah', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nasabahPeroranganDn, 'nilaiTransaksiDalamRupiah'); ?>
                </div>
        </fieldset>        
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nasabahPeroranganDn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>


</div>
</div>

<script>
    $('#NasabahPeroranganDn_idNegaraKewarganegaraan').on('change', function() {
        if ($(this).val() == 999) {
            $("#NasabahPeroranganDn_negaraLainKewarganegaraan").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_negaraLainKewarganegaraan").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganDn_pekerjaan').on('change', function() {
        if ($(this).val() == 19) {
            $("#NasabahPeroranganDn_pekerjaanLain").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_pekerjaanLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganDn_idPropinsiDomisili').on('change', function() {
        if ($(this).val() == 96) {
            $("#NasabahPeroranganDn_propinsiLainDomisili").removeAttr('readonly');
            $("#NasabahPeroranganDn_kabKotaLain").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_propinsiLainDomisili").attr('readonly', 'readonly');
            $("#NasabahPeroranganDn_kabKotaLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganDn_idKabKotaDomisili').on('change', function() {
        if ($(this).val() == 440) {
            $("#NasabahPeroranganDn_kabKotaLain").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_kabKotaLain").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganDn_idPropinsiIdentitas').on('change', function() {
        if ($(this).val() == 96) {
            $("#NasabahPeroranganDn_propinsiLainIdentitas").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_propinsiLainIdentitas").attr('readonly', 'readonly');
        }
    });
    $('#NasabahPeroranganDn_idKabKotaIdentitas').on('change', function() {
        if ($(this).val() == 440) {
            $("#NasabahPeroranganDn_kabKotaLainIdentitas").removeAttr('readonly');
        } else {
            $("#NasabahPeroranganDn_kabKotaLainIdentitas").attr('readonly', 'readonly');
        }
    });
</script>