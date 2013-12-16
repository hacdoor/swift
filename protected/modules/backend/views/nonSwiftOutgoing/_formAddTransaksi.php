<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'addTransaksi-form',
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

        <fieldset class="well">
            <legend>Date Currency Amount</legend>
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

        <fieldset class="well">
            <legend>currencyInstructedAmount</legend>
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

        <fieldset class="well">
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

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton($transaksi->isNewRecord ? 'Tambah' : 'Simpan', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>