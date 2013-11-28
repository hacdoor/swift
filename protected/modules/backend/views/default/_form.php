<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'form-form',
        'enableAjaxValidation' => true,
        'errorMessageCssClass' => 'label label-danger',
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
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
                                <label class="col-md-2 control-label required" for="Input_0">No. LTDLN <span class="required">*</span></label>                
                                <div class="col-md-2">
                                    <input class="form-control" name="Input[0]" id="Input_0" type="text" maxlength="255" value="4325" disabled="disabled">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_4">Pilih Negara <span class="required">*</span></label>                
                                <div class="col-md-2">
                                    <?php
                                    $this->widget('CAutoComplete', array(
                                        'model' => $model,
                                        'attribute' => 'nama',
                                        'url' => array('getNegara'),
                                        'multiple' => false,
                                        'matchCase' => true,
                                        'htmlOptions' => array(
                                            'placeholder' => 'Pilih Negara',
                                            'class' => 'form-control'
                                        ),
                                        'resultsClass' => 'autoResult',
                                        'methodChain' => "
                                            .result(function(event,item){
                                                \$(\"#Input_2\").val(item[0]);
                                                \$(\"#Input_3\").val(item[0]);
                                            })
                                            ",
                                    ));
                                    ?>                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_1">Tanggal Laporan <span class="required">*</span></label>                
                                <div class="col-md-2">
                                    <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_2">Nama Pajak <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_3">Nama Pejabat Pajak <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <input class="form-control" name="Input[3]" id="Input_3" type="text" maxlength="255" value="">                                    
                                </div>
                            </div>
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
                                <li class="active setValue" data-type="Nasabah">
                                    <a href="#tabNasabah" data-toggle="tab">
                                        Nasabah
                                    </a>
                                </li>
                                <li class="setValue" data-type="NonNasabah">
                                    <a href="#tabNonNasabah" data-toggle="tab">
                                        NonNasabah
                                    </a>
                                </li>
                            </ul>

                            <input type="hidden" value="" id="TypeNasabah" name="type[nasabah]"/>

                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="tabNasabah">
                                    <div id="formNasabah" class="formSwift">

                                        <div class="row" style="padding: 0 10px;">
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosNasabah" id="perorangan" data-type="Perorangan" value="option3" checked="checked">
                                                        Perorangan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadiosNasabah" id="korporasi" data-type="Korporasi" value="option4">
                                                        Korporasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="Perorangan" id="TypeForNasabah" name="type[fornasabah]"/>

                                        <div id="formPerorangan" class="formNasabah">

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_1">Tanggal Laporan <span class="required">*</span></label>                
                                                <div class="col-md-2">
                                                    <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_2">Nama Pajak <span class="required">*</span></label>                
                                                <div class="col-md-5">
                                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_3">Nama Pejabat Pajak <span class="required">*</span></label>                
                                                <div class="col-md-5">
                                                    <input class="form-control" name="Input[3]" id="Input_3" type="text" maxlength="255" value="">                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div id="formKorporasi" style="display: none;" class="formNasabah">

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_0">No. LTDLN <span class="required">*</span></label>                
                                                <div class="col-md-2">
                                                    <input class="form-control" name="Input[0]" id="Input_0" type="text" maxlength="255" value="4325" disabled="disabled">                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_1">Tanggal Laporan <span class="required">*</span></label>                
                                                <div class="col-md-2">
                                                    <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_2">Nama Pajak <span class="required">*</span></label>                
                                                <div class="col-md-5">
                                                    <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" for="Input_3">Nama Pejabat Pajak <span class="required">*</span></label>                
                                                <div class="col-md-5">
                                                    <input class="form-control" name="Input[3]" id="Input_3" type="text" maxlength="255" value="">                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabNonNasabah">
                                    <div id="formNonNasabah" class="formSwift">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label required" for="Input_0">No. LTDLN <span class="required">*</span></label>                
                                            <div class="col-md-2">
                                                <input class="form-control" name="Input[0]" id="Input_0" type="text" maxlength="255" value="4325" disabled="disabled">                                    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label required" for="Input_1">Tanggal Laporan <span class="required">*</span></label>                
                                            <div class="col-md-2">
                                                <input class="form-control dateSwift" type="text" name="Input[1]" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label required" for="Input_2">Nama Pajak <span class="required">*</span></label>                
                                            <div class="col-md-5">
                                                <input class="form-control" name="Input[2]" id="Input_2" type="text" maxlength="255" value="">                                    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label required" for="Input_3">Nama Pejabat Pajak <span class="required">*</span></label>                
                                            <div class="col-md-5">
                                                <input class="form-control" name="Input[3]" id="Input_3" type="text" maxlength="255" value="">                                    
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
                            <div class="form-group">
                                <label class="col-md-2 control-label required" for="Input_6">Nama Penerima <span class="required">*</span></label>                
                                <div class="col-md-5">
                                    <div id="addInput" class="btn btn-default"><i class="icon-plus-sign"></i> Tambah Penerima</div>
                                    <div id="appendInput">
                                        <div class="innerInput">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input class="form-control" name="NamaPenerima[0]" id="NamaPenerima" type="text" maxlength="255" value="" placeholder="Nama Penerima">
                                                </div>
                                                <div class="col-md-3">

                                                </div>
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                <i class="glyphicon glyphicon-ok-sign"></i> Transaksi
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>

    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend/swift" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>