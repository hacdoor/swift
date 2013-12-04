<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="form-group">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-pencil"></span> Update <?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $_GET['type']))); ?>
                <a href="<?php echo $this->vars['backendUrl']; ?>swift?type=<?php echo $_GET['type']; ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="form-group"> <div class="form-wrapper">

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'user-_form-form',
                        'enableAjaxValidation' => true,
                        'errorMessageCssClass' => 'label label-danger',
                        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
                    ));
                    ?>

                    <div class="col-md-12">


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
                                                <?php echo $form->textField($model, 'tglLaporan', array('value' => date_format(date_create($model->tglLaporan), 'd-m-Y'), 'class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
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
                                        <?php echo $form->hiddenField($model, 'jenisSwift', array('value' => $model->getIdByType($_GET['type']))); ?>
                                        <?php echo $form->hiddenField($model, 'status', array('value' => Swift::STATUS_DRAFT)); ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($_GET['type'] == 'SwIn'): ?>
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

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPengirimNasabah" name="type[nasabah]"/>

                                        <div id="formPengirimPerorangan" class="formPengirimNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganLn_form', array('model' => $nasabahPeroranganLn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPengirimKorporasi" style="display: none;" class="formPengirimNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiLn_form', array('model' => $nasabahKorporasiLn, 'form' => $form)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            <i class="glyphicon glyphicon-ok-sign"></i> Identitas Penerima
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPenerimaNasabah" name="type[nasabah]"/>

                                        <div id="formPenerimaPerorangan" class="formPenerimaNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganDn_form', array('model' => $nasabahPeroranganDn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPenerimaKorporasi" style="display: none;" class="formPenerimaNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiDn_form', array('model' => $nasabahKorporasiDn, 'form' => $form)); ?>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($_GET['type'] == 'SwOut'): ?>
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

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPengirimNasabah" name="type[nasabah]"/>

                                        <div id="formPengirimPerorangan" class="formPengirimNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganDn_form', array('model' => $nasabahPeroranganDn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPengirimKorporasi" style="display: none;" class="formPengirimNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiDn_form', array('model' => $nasabahKorporasiDn, 'form' => $form)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <i class="glyphicon glyphicon-ok-sign"></i> Identitas Beneficial Owner
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php $this->renderPartial('_nonNasabahDn_form', array('model' => $nonNasabahDn, 'form' => $form)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            <i class="glyphicon glyphicon-ok-sign"></i> Identitas Penerima
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPenerimaNasabah" name="type[nasabah]"/>

                                        <div id="formPenerimaPerorangan" class="formPenerimaNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganLn_form', array('model' => $nasabahPeroranganLn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPenerimaKorporasi" style="display: none;" class="formPenerimaNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiLn_form', array('model' => $nasabahKorporasiLn, 'form' => $form)); ?>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($_GET['type'] == 'NonSwIn'): ?>

                        <?php elseif ($_GET['type'] == 'NonSwOut'): ?>
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

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPengirimNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPengirimNasabah" name="type[nasabah]"/>

                                        <div id="formPengirimPerorangan" class="formPengirimNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganDn_form', array('model' => $nasabahPeroranganDn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPengirimKorporasi" style="display: none;" class="formPengirimNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiDn_form', array('model' => $nasabahKorporasiDn, 'form' => $form)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <i class="glyphicon glyphicon-ok-sign"></i> Identitas Beneficial Owner
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
                                            <i class="glyphicon glyphicon-ok-sign"></i> Identitas Penerima
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="perorangan" data-type="1" value="1" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosPenerimaNasabah" id="korporasi" data-type="2" value="2">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="1" id="TypeForPenerimaNasabah" name="type[nasabah]"/>

                                        <div id="formPenerimaPerorangan" class="formPenerimaNasabah">
                                            <hr />
                                            <?php $this->renderPartial('_nasabahPeroranganLn_form', array('model' => $nasabahPeroranganLn, 'form' => $form)); ?>

                                        </div>

                                        <div id="formPenerimaKorporasi" style="display: none;" class="formPenerimaNasabah">

                                            <hr/>
                                            <?php $this->renderPartial('_nasabahKorporasiLn_form', array('model' => $nasabahKorporasiLn, 'form' => $form)); ?>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Transaksi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <fieldset>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'tglTransaksi', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'tglTransaksi', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                                                <?php echo $form->error($transaksi, 'tglTransaksi'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'timeIndication', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'timeIndication', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'timeIndication'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'sendersReference', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'sendersReference', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'sendersReference'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'relatedReference', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'relatedReference', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'relatedReference'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'bankOperationCode', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'bankOperationCode', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'bankOperationCode'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'instructionCode', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'instructionCode', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'instructionCode'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'kanCabPenyelenggaraPengirimAsal', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'kanCabPenyelenggaraPengirimAsal', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'kanCabPenyelenggaraPengirimAsal'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'typeTransactionCode', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'typeTransactionCode', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'typeTransactionCode'); ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset><legend>Date Currency Amount</legend>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'valueDate', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'valueDate', array('class' => 'form-control dateSwift', 'readonly' => 'readonly', 'data-date-format' => 'dd-mm-yyyy')); ?>
                                                <?php echo $form->error($transaksi, 'valueDate'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'amount', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'amount', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'amount'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'idCurrency', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->dropDownList($transaksi, 'idCurrency', Yii::app()->util->getKodeStandar(array('modul' => 'mataUang', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'idCurrency'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'amountDalamRupiah', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'amountDalamRupiah', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'amountDalamRupiah'); ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset><legend>currencyInstructedAmount</legend>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'idCurrencyInstructedAmount', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->dropDownList($transaksi, 'idCurrencyInstructedAmount', Yii::app()->util->getKodeStandar(array('modul' => 'mataUang', 'data' => 'all&blank')), array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'idCurrencyInstructedAmount'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'instructedAmount', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'instructedAmount', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'instructedAmount'); ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'exchangeRate', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'exchangeRate', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'exchangeRate'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'sendingInstitution', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'sendingInstitution', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'sendingInstitution'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'beneficiaryInstitution', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'beneficiaryInstitution', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'beneficiaryInstitution'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'tujuanTransaksi', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'tujuanTransaksi', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'tujuanTransaksi'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form->labelEx($transaksi, 'sumberDana', array('class' => 'col-md-2 control-label')); ?>
                                            <div class="col-md-5">
                                                <?php echo $form->textField($transaksi, 'sumberDana', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($transaksi, 'sumberDana'); ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                        <i class="glyphicon glyphicon-ok-sign"></i> Info Lainnya
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'infSendersCorrespondent', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'infSendersCorrespondent', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'infSendersCorrespondent'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'infReceiverCorrespondent', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'infReceiverCorrespondent', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'infReceiverCorrespondent'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'infThirdReimbursementInstitution', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'infThirdReimbursementInstitution', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'infThirdReimbursementInstitution'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'infIntermediaryInstitution', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'infIntermediaryInstitution', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'infIntermediaryInstitution'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'infBeneficiaryCustomerAccountInstitution', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'infBeneficiaryCustomerAccountInstitution', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'infBeneficiaryCustomerAccountInstitution'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'remittanceInformation', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'remittanceInformation', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'remittanceInformation'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'senderToReceiverInformation', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'senderToReceiverInformation', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'senderToReceiverInformation'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'regulatoryReporting', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'regulatoryReporting', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'regulatoryReporting'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($infoLain, 'envelopeContents', array('class' => 'col-md-2 control-label')); ?>
                                        <div class="col-md-5">
                                            <?php echo $form->textField($infoLain, 'envelopeContents', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($infoLain, 'envelopeContents'); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 clear form-actions">
                        <hr>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/swift?type=<?php echo $_GET['type']; ?>" class="btn btn-lg btn-default">Cancel</a>
                        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
                    </div>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->
                <?php
//                $this->renderPartial('/swift/_form', array(
//                    'model' => $model,
//                    'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
//                    'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
//                    'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn
//                ));
                ?>
            </div>
        </div>
    </div>
</div>

<script>

    $(".radio input[name$='optionsRadiosPengirimNasabah']").click(function() {
        var type = $(this).data('type');
        var t = (type == 1) ? 'formPengirimPerorangan' : 'formPengirimKorporasi';
        $(".formPengirimNasabah").hide();
        $("#" + t).show();
        $("#TypeForPengirimNasabah").val(type);
    });

    $('.setValue').each(function() {
        $(".setValue").click(function() {
            var type = $(this).data('type');
            $("#TypePengirimNasabah").val(type);
        });
    });

    if ($(".radio input[name$='optionsRadiosPengirimNasabah']").is('checked')) {
        var type = $(this).data('type');
        $("#TypeForPengirimNasabah").val(type);
    }
    ;

    var type = $("#myTab li.active").data('type');
    $("#TypePengirimNasabah").val(type);

    $(".radio input[name$='optionsRadiosPenerimaNasabah']").click(function() {
        var type = $(this).data('type');
        var t = (type == 1) ? 'formPenerimaPerorangan' : 'formPenerimaKorporasi';
        $(".formPenerimaNasabah").hide();
        $("#" + t).show();
        $("#TypeForPenerimaNasabah").val(type);
    });

    $('.setValue').each(function() {
        $(".setValue").click(function() {
            var type = $(this).data('type');
            $("#TypePenerimaNasabah").val(type);
        });
    });

    if ($(".radio input[name$='optionsRadiosPenerimaNasabah']").is('checked')) {
        var type = $(this).data('type');
        $("#TypeForPenerimaNasabah").val(type);
    }
    ;

    var type = $("#myTab li.active").data('type');
    $("#TypePenerimaNasabah").val(type);
    
    
    $('#Swift_jenisLaporan').on('change', function() {
        if ($(this).val() == 1 || $(this).val() == '') {
            $("#Swift_noLtdlnKoreksi").attr('readonly','readonly');
        } else {
            $("#Swift_noLtdlnKoreksi").removeAttr('readonly');
        }
    });
</script>