<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-_form-form',
        'enableAjaxValidation' => true,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-12">

        <fieldset>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <i class="glyphicon glyphicon-ok-sign"></i> Umum
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'jenisLaporan', array('class' => 'col-md-2 control-label')); ?>
                                <div class="col-md-2">
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
                                <?php echo $form->labelEx($model, 'noLtdln', array('class' => 'col-md-2 control-label')); ?>
                                <div class="col-md-2">
                                    <?php echo $form->textField($model, 'noLtdln', array('class' => 'form-control', 'readonly' => 'readonly', 'value' => isset($number) ? $number : $model->noLtdln)); ?>
                                    <?php echo $form->error($model, 'noLtdln'); ?>
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
                                <?php echo $form->labelEx($model, 'pjkBankSebagai', array('class' => 'col-md-2 control-label')); ?>
                                <div class="col-md-5">
                                    <?php echo $form->dropDownList($model, 'pjkBankSebagai', Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagai', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'pjkBankSebagai'); ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <i class="glyphicon glyphicon-ok-sign"></i> Identitas Pengirim 
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">

                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active setValue" data-type="1">
                                    <a href="#tabNasabah" data-toggle="tab">
                                        Nasabah
                                    </a>
                                </li>
                                <li class="setValue" data-type="2">
                                    <a href="#tabNonNasabah" data-toggle="tab">
                                        NonNasabah
                                    </a>
                                </li>
                            </ul>

                            <input type="hidden" value="" id="TypeNasabah" name="type[pengirim]"/>

                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="tabNasabah">
                                    <div id="formNasabah" class="formSwift">

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForNasabah" name="type[nasabah]"/>

                                        <div id="formPerorangan" class="formNasabah">

                                            <hr/>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php
                                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                                        'model' => $peroranganPengirimSwIn,
                                                        'attribute' => 'noRekening',
                                                        'source' => $this->createUrl('swift/autocomplete'),
                                                        'options' => array(
                                                            'delay' => 100,
                                                            'minLength' => 2,
                                                            'showAnim' => 'fold',
                                                            'select' => "js:function(event, ui) {
                                                                $(\"#PeroranganPengirimSwIn_namaLengkap\").val(ui.item.namaLengkap);
                                                                $(\"#PeroranganPengirimSwIn_tglLahir\").val(ui.item.tglLahir);
                                                                $(\"#PeroranganPengirimSwIn_kewarganegaraan\").val(ui.item.kewarganegaraan);
                                                                $(\"#PeroranganPengirimSwIn_alamat\").val(ui.item.alamat);
                                                                $(\"#PeroranganPengirimSwIn_noTelp\").val(ui.item.noTelp);
                                                                
                                                                $(\"#PeroranganPengirimSwIn_namaLengkap\").attr('readonly', 'readonly');
                                                                $(\"#PeroranganPengirimSwIn_tglLahir\").attr('readonly', 'readonly');
                                                                $(\"#PeroranganPengirimSwIn_kewarganegaraan\").attr('readonly', 'readonly');
                                                                $(\"#PeroranganPengirimSwIn_alamat\").attr('readonly', 'readonly');
                                                                $(\"#PeroranganPengirimSwIn_noTelp\").attr('readonly', 'readonly');
                                                        }"
                                                        ),
                                                        'htmlOptions' => array(
                                                            'size' => '40',
                                                            'class' => 'form-control'
                                                        ),
                                                    ));
                                                    ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'noRekening'); ?>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'namaLengkap', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'namaLengkap'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-2">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'tglLahir'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'kewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->dropDownList($peroranganPengirimSwIn, 'kewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'kewarganegaraan'); ?>
                                                </div>
                                            </div>
                                            <div id="formKewarganegaraan" style="display: none;" class="formKewarganegaraan">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($peroranganPengirimSwIn, 'idNegaraKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                                                    <div class="col-md-5">
                                                        <?php echo $form->dropDownList($peroranganPengirimSwIn, 'idNegaraKewarganegaraan', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                        <?php echo $form->error($peroranganPengirimSwIn, 'idNegaraKewarganegaraan'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="formNegaraLainnyaKewarganegaraan" style="display: none;" class="formNegaraLainnyaKewarganegaraan">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($peroranganPengirimSwIn, 'negaraLainnyaKewarganegaraan', array('class' => 'col-md-2 control-label')); ?>
                                                    <div class="col-md-5">
                                                        <?php echo $form->textField($peroranganPengirimSwIn, 'negaraLainnyaKewarganegaraan', array('class' => 'form-control')); ?>
                                                        <?php echo $form->error($peroranganPengirimSwIn, 'negaraLainnyaKewarganegaraan'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'alamat', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'alamat'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'negaraBagianKota'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'idNegaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->dropDownList($peroranganPengirimSwIn, 'idNegaraBagianKota', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'idNegaraBagianKota'); ?>
                                                </div>
                                            </div>
                                            <div id="formNegaraLainnyaBagianKotaNasabah" style="display: none;" class="formNegaraLainnyaBagianKotaNasabah">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($peroranganPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                    <div class="col-md-5">
                                                        <?php echo $form->textField($peroranganPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'form-control')); ?>
                                                        <?php echo $form->error($peroranganPengirimSwIn, 'negaraLainnyaBagianKota'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'noTelp', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'noTelp'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'ktp', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'ktp', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'ktp'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'sim', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'sim', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'sim'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'passport', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'passport', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'passport'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'kimsKitasKitab', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'kimsKitasKitab', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'kimsKitasKitab'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'npwp', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'npwp', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'npwp'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'jenisBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'jenisBuktiLain', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'jenisBuktiLain'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($peroranganPengirimSwIn, 'noBuktiLain', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($peroranganPengirimSwIn, 'noBuktiLain', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($peroranganPengirimSwIn, 'noBuktiLain'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="formKorporasi" style="display: none;" class="formNasabah">

                                            <hr/>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php
                                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                                        'model' => $korporasiPengirimSwIn,
                                                        'attribute' => 'noRekening',
                                                        'source' => $this->createUrl('swift/rekeningkorporasi'),
                                                        'options' => array(
                                                            'delay' => 100,
                                                            'minLength' => 2,
                                                            'showAnim' => 'fold',
                                                            'select' => "js:function(event, ui) {
                                                                $(\"#KorporasiPengirimSwIn_namaKorporasi\").val(ui.item.namaKorporasi);
                                                                $(\"#KorporasiPengirimSwIn_alamat\").val(ui.item.alamat);
                                                                $(\"#KorporasiPengirimSwIn_noTelp\").val(ui.item.noTelp);
                                                                
                                                                $(\"#KorporasiPengirimSwIn_namaKorporasi\").attr('readonly', 'readonly');
                                                                $(\"#KorporasiPengirimSwIn_alamat\").attr('readonly', 'readonly');
                                                                $(\"#KorporasiPengirimSwIn_noTelp\").attr('readonly', 'readonly');
                                                        }"
                                                        ),
                                                        'htmlOptions' => array(
                                                            'size' => '40',
                                                            'class' => 'form-control'
                                                        ),
                                                    ));
                                                    ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'noRekening'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'namaKorporasi', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($korporasiPengirimSwIn, 'namaKorporasi', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'namaKorporasi'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($korporasiPengirimSwIn, 'alamat', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'alamat'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($korporasiPengirimSwIn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'negaraBagianKota'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'idNegaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->dropDownList($korporasiPengirimSwIn, 'idNegaraBagianKota', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'idNegaraBagianKota'); ?>
                                                </div>
                                            </div>
                                            <div id="formNegaraLainnyaBagianKota" style="display: none;" class="formNegaraLainnyaBagianKota">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($korporasiPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                    <div class="col-md-5">
                                                        <?php echo $form->textField($korporasiPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'form-control')); ?>
                                                        <?php echo $form->error($korporasiPengirimSwIn, 'negaraLainnyaBagianKota'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($korporasiPengirimSwIn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($korporasiPengirimSwIn, 'noTelp', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($korporasiPengirimSwIn, 'noTelp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabNonNasabah">
                                    <div id="formNonNasabah" class="formSwift">
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'noRekening', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'noRekening', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'noRekening'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'namaLengkap', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'namaLengkap', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'namaLengkap'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'tglLahir', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-2">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'tglLahir', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'tglLahir'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'alamat', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'alamat', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'alamat'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'negaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'negaraBagianKota', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'negaraBagianKota'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'idNegaraBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->dropDownList($nonNasabahPengirimSwIn, 'idNegaraBagianKota', Yii::app()->util->getKodeStandar(array('modul' => 'negara', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'idNegaraBagianKota'); ?>
                                            </div>
                                        </div>
                                        <div id="formNegaraLainnyaBagianKotaNonNasabah" style="display: none;" class="formNegaraLainnyaBagianKotaNonNasabah">
                                            <div class="form-group">
                                                <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'col-md-2 control-label')); ?>
                                                <div class="col-md-5">
                                                    <?php echo $form->textField($nonNasabahPengirimSwIn, 'negaraLainnyaBagianKota', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($nonNasabahPengirimSwIn, 'negaraLainnyaBagianKota'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($nonNasabahPengirimSwIn, 'noTelp', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($nonNasabahPengirimSwIn, 'noTelp', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($nonNasabahPengirimSwIn, 'noTelp'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <i class="glyphicon glyphicon-ok-sign"></i> Identitas Penerima
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                <i class="glyphicon glyphicon-ok-sign"></i> Transaksi
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_1">Tanggal Transaksi <span class="required">*</span></label>                
                                <div class="col-md-2">
                                    <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Waktu transaksi diproses <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Sender's Reference <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Related Reference <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Bank Operation Code <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Instruction Code  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_3">Kantor cabang penyelenggara pengirim asal </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[3]" id="Input_3" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Kode tipe transaksi <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_1">Tanggal transaksi (value date) <span class="required">*</span></label>                
                                <div class="col-md-2">
                                    <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Nilai transaksi  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Mata uang transaksi  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Amount Dalam Rupiah  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Currency  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Instructed Amount  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Nilai Tukar  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Sending Institution  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Beneficiary Institution  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Tujuan Transaksi  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Sumber Penggunaan dana  <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                <i class="glyphicon glyphicon-ok-sign"></i> Informasi Lainnya
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Information about the sender's correspondent  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Information about the receiver's correspondent  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Information about the third reimbursement institution  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Information about the intermediary institution  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Information about the beneficiary customer account institution  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Remittance Information  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Sender to receiver information  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Regulatory Reporting  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Envelope contents  </label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/swift?type=<?php echo $_GET['type']; ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $('#PeroranganPengirimSwIn_noRekening').on('keyup', function() {
        var data = $(this).val();
        if (data == '') {
            $('#PeroranganPengirimSwIn_namaLengkap').val('');
            $('#PeroranganPengirimSwIn_tglLahir').val('');
            $('#PeroranganPengirimSwIn_kewarganegaraan').val('');
            $('#PeroranganPengirimSwIn_alamat').val('');
            $('#PeroranganPengirimSwIn_noTelp').val('');

            $('#PeroranganPengirimSwIn_namaLengkap').removeAttr('readonly');
            $('#PeroranganPengirimSwIn_tglLahir').removeAttr('readonly');
            $('#PeroranganPengirimSwIn_kewarganegaraan').removeAttr('readonly');
            $('#PeroranganPengirimSwIn_alamat').removeAttr('readonly');
            $('#PeroranganPengirimSwIn_noTelp').removeAttr('readonly');
        }
    });
    $('#KorporasiPengirimSwIn_noRekening').on('keyup', function() {
        var data = $(this).val();
        if (data == '') {
            $('#KorporasiPengirimSwIn_namaKorporasi').val('');
            $('#KorporasiPengirimSwIn_alamat').val('');
            $('#KorporasiPengirimSwIn_noTelp').val('');

            $('#KorporasiPengirimSwIn_namaKorporasi').removeAttr('readonly');
            $('#KorporasiPengirimSwIn_alamat').removeAttr('readonly');
            $('#KorporasiPengirimSwIn_noTelp').removeAttr('readonly');
        }
    });
    $('#KorporasiPengirimSwIn_idNegaraBagianKota').on('change', function() {
        var data = $(this).val();
        if (data == 999) {
            $("#formNegaraLainnyaBagianKota").show();
        } else {
            $("#formNegaraLainnyaBagianKota").hide();
        }
    });
    $('#NonNasabahPengirimSwIn_idNegaraBagianKota').on('change', function() {
        var data = $(this).val();
        if (data == 999) {
            $("#formNegaraLainnyaBagianKotaNonNasabah").show();
        } else {
            $("#formNegaraLainnyaBagianKotaNonNasabah").hide();
        }
    });

    $('#PeroranganPengirimSwIn_kewarganegaraan').on('change', function() {
        var data = $(this).val();
        if (data == 2) {
            $("#formKewarganegaraan").show();
            $('#PeroranganPengirimSwIn_idNegaraKewarganegaraan').val('');
        } else {
            $('#PeroranganPengirimSwIn_idNegaraKewarganegaraan').val(62);
            $("#formKewarganegaraan").hide();
            $("#formNegaraLainnyaKewarganegaraan").hide();
        }
    });

    $('#PeroranganPengirimSwIn_idNegaraKewarganegaraan').on('change', function() {
        var data = $(this).val();
        if (data == 999) {
            $("#formNegaraLainnyaKewarganegaraan").show();
        } else {
            $("#formNegaraLainnyaKewarganegaraan").hide();
        }
    });

    $('#PeroranganPengirimSwIn_idNegaraBagianKota').on('change', function() {
        var data = $(this).val();
        if (data == 999) {
            $("#formNegaraLainnyaBagianKotaNasabah").show();
        } else {
            $("#formNegaraLainnyaBagianKotaNasabah").hide();
        }
    });

</script>