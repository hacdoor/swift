<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'nasabah-korporasi-form',
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
                <?php echo $form->labelEx($model, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo $form->textField($model, 'noRekening', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'noRekening'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'namaKorporasi', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'namaKorporasi', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'namaKorporasi'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idBentukBadan', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idBentukBadan', Yii::app()->util->getKodeStandar(array('modul' => 'bentukBadanUsaha', 'data' => 'all&blank')), array('class' => 'form-control chzn-select')); ?>
                    <?php echo $form->error($model, 'idBentukBadan'); ?>
                </div>
            </div>
            <div id="formBentukBadanLainnya" style="display: none;" class="formBentukBadanLainnya">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bentukBadanLainnya', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'bentukBadanLainnya', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'bentukBadanLainnya'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'idBidangUsaha', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->dropDownList($model, 'idBidangUsaha', Yii::app()->util->getKodeStandar(array('modul' => 'bidangUsaha', 'data' => 'all&blank')), array('class' => 'form-control chzn-select')); ?>
                    <?php echo $form->error($model, 'idBidangUsaha'); ?>
                </div>
            </div>
            <div id="formBidangUsahaLainnya" style="display: none;" class="formBidangUsahaLainnya">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'bidangUsahaLainnya', array('class' => 'col-md-2 control-label')); ?>
                    <div class="col-md-5">
                        <?php echo $form->textField($model, 'bidangUsahaLainnya', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'bidangUsahaLainnya'); ?>
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
                <?php echo $form->labelEx($model, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->textField($model, 'noTelp', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'noTelp'); ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/nasabahKorporasi" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>

<script>
    var baseUrl = "<?php echo Yii::app()->request->baseUrl; ?>";
    $('#NasabahKorporasi_idBentukBadan').on('change', function() {
        var data = $(this).val();
        if (data == 9) {
            $("#formBentukBadanLainnya").show();
        } else {
            $("#formBentukBadanLainnya").hide();
        }
    });

    $('#NasabahKorporasi_idBidangUsaha').on('change', function() {
        var data = $(this).val();
        if (data == 22) {
            $("#formBidangUsahaLainnya").show();
        } else {
            $("#formBidangUsahaLainnya").hide();
        }
    });

    $('#NasabahKorporasi_idPropinsi').on('change', function() {
        var dataId = $(this).val();

        if (dataId == 96) {
            $("#formPropinsiLainnya").show();
        } else {
            $("#formPropinsiLainnya").hide();
        }
        var obj = $(this);
        if (obj.val() != '') {
            var kelSelect = $('#NasabahKorporasi_idKabKota');
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
            var kelSelect = $('#NasabahKorporasi_idKabKota');
            kelSelect.find('option').remove();
            kelSelect.append('<option value="">Pilih</option>');
            kelSelect.attr('disabled', 'disabled');
        }
    });

    $('#NasabahKorporasi_idKabKota').on('change', function() {
        var dataId = $(this).val();
        if (dataId == 440) {
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
                        $('#NasabahKorporasi_idPropinsi').val(o['id']);
                    });
                    
                },
                error: function() {
                    alert('Koneksi terputus, periksa koneksi Internet Anda.');
                }
            });
        }
    });
</script>