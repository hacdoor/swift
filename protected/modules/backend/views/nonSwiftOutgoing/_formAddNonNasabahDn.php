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
<!--            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'kodeRahasia', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'kodeRahasia', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'kodeRahasia'); ?>
                </div>
            </div>-->

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'noRekening'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'namaLengkap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'namaLengkap'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                    <?php echo $form->error($nonNasabahDn, 'tglLahir'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset><legend>ALamat Sesuai Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'alamat'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'noTelp'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'idPropinsi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nonNasabahDn, 'idPropinsi', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array(
                        'class' => 'form-control',
                        'ajax' => array(
                            'type' => 'POST', //request type
                            'url' => Yii::app()->createUrl('backend/swift/dynamicNegaraNonNasabahDnPropinsi'),
                            'update' => '#NonNasabahDn_idKabKota',
                    ))); ?>
                    <?php echo $form->error($nonNasabahDn, 'idPropinsi'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'propinsiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'propinsiLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nonNasabahDn, 'propinsiLain'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'idKabKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($nonNasabahDn, 'idKabKota', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'idKabKota'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'kabKotaLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'kabKotaLain', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($nonNasabahDn, 'kabKotaLain'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset><legend>Bukti Identitas</legend>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'ktp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'ktp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'ktp'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'sim', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'sim', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'sim'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'passport', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'passport', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'passport'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'kimsKitasKitap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'kimsKitasKitap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'kimsKitasKitap'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'npwp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'npwp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'npwp'); ?>
                </div>
            </div>
            <fieldset><legend>Bukti Lain</legend>
                <div class="form-group">
                    <?php echo $form->labelEx($nonNasabahDn, 'jenisBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($nonNasabahDn, 'jenisBuktiLain', array('class' => 'form-control')); ?>
                        <?php echo $form->error($nonNasabahDn, 'jenisBuktiLain'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($nonNasabahDn, 'noBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($nonNasabahDn, 'noBuktiLain', array('class' => 'form-control')); ?>
                        <?php echo $form->error($nonNasabahDn, 'noBuktiLain'); ?>
                    </div>
                </div>
            </fieldset>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($nonNasabahDn, 'hubDgnPemilikDana', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($nonNasabahDn, 'hubDgnPemilikDana', array('class' => 'form-control')); ?>
                    <?php echo $form->error($nonNasabahDn, 'hubDgnPemilikDana'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($nonNasabahDn->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $('#NonNasabahDn_idPropinsi').on('change', function() {
        if ($(this).val() == 96) {
            $("#NonNasabahDn_propinsiLain").removeAttr('readonly');
        } else {
            $("#NonNasabahDn_propinsiLain").attr('readonly', 'readonly');
        }
    });
    $('#NonNasabahDn_idKabKota').on('change', function() {
        if ($(this).val() == 440) {
            $("#NonNasabahDn_kabKotaLain").removeAttr('readonly');
        } else {
            $("#NonNasabahDn_kabKotaLain").attr('readonly', 'readonly');
        }
    });
</script>