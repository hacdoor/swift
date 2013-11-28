<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-_form-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">

        <fieldset>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'noRekening'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'namaLengkap', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaLengkap'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                    <?php echo $form->error($model, 'tglLahir'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'kewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'kewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'kewarganegaraan'); ?>
                </div>
            </div>
            <div id="formKewarganegaraan" style="display: none;" class="formKewarganegaraan">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'idNegaraKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->dropDownList($model, 'idNegaraKewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'idNegaraKewarganegaraan'); ?>
                    </div>
                </div>
            </div>
            <div id="formNegaraLainnyaKewarganegaraan" style="display: none;" class="formNegaraLainnyaKewarganegaraan">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'negaraLainnyaKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'negaraLainnyaKewarganegaraan', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'negaraLainnyaKewarganegaraan'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idPekerjaan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idPekerjaan', Yii::app()->util->getKodeStandar(array('modul' => 'pekerjaan', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'idPekerjaan'); ?>
                </div>
            </div>
            <div id="formPekerjaanLainnya" style="display: none;" class="formPekerjaanLainnya">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pekerjaanLainnya', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'pekerjaanLainnya', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'pekerjaanLainnya'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'alamat', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'alamat'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idPropinsi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idPropinsi', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'idPropinsi'); ?>
                </div>
            </div>
            <div id="formPropinsiLainnya" style="display: none;" class="formPropinsiLainnya">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'propinsiLainnya', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'propinsiLainnya', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'propinsiLainnya'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idKabKota', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idKabKota', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'idKabKota'); ?>
                </div>
            </div>
            <div id="formKabKotaLainnya" style="display: none;" class="formKabKotaLainnya">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'kabKotaLainnya', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'kabKotaLainnya', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'kabKotaLainnya'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'alamatBuktiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'alamatBuktiIdentitas', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'alamatBuktiIdentitas'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idPropinsiBuktiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idPropinsiBuktiIdentitas', Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'idPropinsiBuktiIdentitas'); ?>
                </div>
            </div>
            <div id="formPropinsiLainnyaBuktiIdentitas" style="display: none;" class="formPropinsiLainnyaBuktiIdentitas">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'propinsiLainnyaBuktiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'propinsiLainnyaBuktiIdentitas', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'propinsiLainnyaBuktiIdentitas'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idKabKotaBuktiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idKabKotaBuktiIdentitas', Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'idKabKotaBuktiIdentitas'); ?>
                </div>
            </div>
            <div id="formKabKotaLainnyaBuktiIdentitas" style="display: none;" class="formKabKotaLainnyaBuktiIdentitas">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'kabKotaLainnyaBuktiIdentitas', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'kabKotaLainnyaBuktiIdentitas', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'kabKotaLainnyaBuktiIdentitas'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'noTelp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'ktp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'ktp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'ktp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'sim', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'sim', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'sim'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'passport', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'passport', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'passport'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'kimsKitasKitab', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'kimsKitasKitab', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'kimsKitasKitab'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'npwp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'npwp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'npwp'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'jenisBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'jenisBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'jenisBuktiLain'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'noBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'noBuktiLain', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'noBuktiLain'); ?>
                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/nasabahPerorangan" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    var baseUrl = "<?php echo Yii::app()->request->baseUrl; ?>";
    $('#NasabahPerorangan_idPropinsi').on('change', function() {
        var data = $(this).val();
        if (data == 96) {
            $("#formPropinsiLainnya").show();
        } else {
            $("#formPropinsiLainnya").hide();
        }
        var obj = $(this);
        if (obj.val() != '') {
            var kelSelect = $('#NasabahPerorangan_idKabKota');
            var url = baseUrl + '/backend/kabupaten/getkota/' + obj.val() + '?callback=spin8108';
            
            kelSelect.attr('disabled', 'disabled');

            xhr = $.ajax({
                type: 'GET',
                dataType: 'jsonp',
                url: url,
                success: function(data) {
                    kelSelect.find('option').remove();
                    kelSelect.append('<option value="">Pilih</option>');
                    $.each(data, function(i, o) {
                        kelSelect.append('<option value="' + o['id'] + '">' + o['nama'] + '</option>');
                    });
//                    kelSelect.append('<option value="' + 440 + '">Lain-lain</option>');
                    kelSelect.removeAttr('disabled');
                },
                error: function() {
                    alert('Koneksi terputus, periksa koneksi Internet Anda.');
                }
            });
        } else {
            var kelSelect = $('#NasabahPerorangan_idKabKota');
            kelSelect.find('option').remove();
            kelSelect.append('<option value="">Pilih</option>');
            kelSelect.attr('disabled', 'disabled');
        }
    });

    $('#NasabahPerorangan_idKabKota').on('change', function() {
        var data = $(this).val();
        if (data == 440) {
            $("#formKabKotaLainnya").show();
        } else {
            $("#formKabKotaLainnya").hide();
        }
        var obj = $(this);
        if (obj.val() != '') {
            var url = baseUrl + '/backend/propinsi/getpropinsi/' + obj.val() + '?callback=spin8108';

            xhr = $.ajax({
                type: 'GET',
                dataType: 'jsonp',
                url: url,
                success: function(data) {
                    $.each(data, function(i, o) {
                        $('#NasabahPerorangan_idPropinsi').val(o['id']);
                    });

                },
                error: function() {
                    alert('Koneksi terputus, periksa koneksi Internet Anda.');
                }
            });
        }
    });

    $('#NasabahPerorangan_kewarganegaraan').on('change', function() {
        var data = $(this).val();
        if (data == 2) {
            $("#formKewarganegaraan").show();
        } else {
            $("#formKewarganegaraan").hide();
            $("#formNegaraLainnyaKewarganegaraan").hide();
        }
    });

    $('#NasabahPerorangan_idNegaraKewarganegaraan').on('change', function() {
        var data = $(this).val();
        if (data == 999) {
            $("#formNegaraLainnyaKewarganegaraan").show();
        } else {
            $("#formNegaraLainnyaKewarganegaraan").hide();
        }
    });

    $('#NasabahPerorangan_idPekerjaan').on('change', function() {
        var data = $(this).val();
        if (data == 19) {
            $("#formPekerjaanLainnya").show();
        } else {
            $("#formPekerjaanLainnya").hide();
        }
    });

    $('#NasabahPerorangan_idPropinsiBuktiIdentitas').on('change', function() {
        var data = $(this).val();
        if (data == 96) {
            $("#formPropinsiLainnyaBuktiIdentitas").show();
        } else {
            $("#formPropinsiLainnyaBuktiIdentitas").hide();
        }
        var obj = $(this);
        if (obj.val() != '') {
            var kelSelect = $('#NasabahPerorangan_idKabKotaBuktiIdentitas');
            var url = baseUrl + '/backend/kabupaten/getkota/' + obj.val() + '?callback=spin8108';
            
            kelSelect.attr('disabled', 'disabled');

            xhr = $.ajax({
                type: 'GET',
                dataType: 'jsonp',
                url: url,
                success: function(data) {
                    kelSelect.find('option').remove();
                    kelSelect.append('<option value="">Pilih</option>');
                    $.each(data, function(i, o) {
                        kelSelect.append('<option value="' + o['id'] + '">' + o['nama'] + '</option>');
                    });
//                    kelSelect.append('<option value="' + 440 + '">Lain-lain</option>');
                    kelSelect.removeAttr('disabled');
                },
                error: function() {
                    alert('Koneksi terputus, periksa koneksi Internet Anda.');
                }
            });
        } else {
            var kelSelect = $('#NasabahPerorangan_idKabKotaBuktiIdentitas');
            kelSelect.find('option').remove();
            kelSelect.append('<option value="">Pilih</option>');
            kelSelect.attr('disabled', 'disabled');
        }
    });

    $('#NasabahPerorangan_idKabKotaBuktiIdentitas').on('change', function() {
        var data = $(this).val();
        if (data == 440) {
            $("#formKabKotaLainnyaBuktiIdentitas").show();
        } else {
            $("#formKabKotaLainnyaBuktiIdentitas").hide();
        }
        var obj = $(this);
        if (obj.val() != '') {
            var url = baseUrl + '/backend/propinsi/getpropinsi/' + obj.val() + '?callback=spin8108';

            xhr = $.ajax({
                type: 'GET',
                dataType: 'jsonp',
                url: url,
                success: function(data) {
                    $.each(data, function(i, o) {
                        $('#NasabahPerorangan_idPropinsiBuktiIdentitas').val(o['id']);
                    });

                },
                error: function() {
                    alert('Koneksi terputus, periksa koneksi Internet Anda.');
                }
            });
        }
    });

</script>