<div class="form-wrapper">

    <?php
    echo CHtml::beginForm(
            $this->vars['backendUrl'] . 'swift/generateXml', 'GET', array(
        'class' => 'form-horizontal'
            )
    );
    ?>

    <div class="col-md-12">

        <fieldset>

            <div class="form-group">
                <label class="col-md-2 control-label required" for="Input_1">Tanggal Mulai <span class="required">*</span></label>                
                <div class="col-md-2">
                    <input id="Input_1" class="form-control dateSwift" type="text" name="tanggalMulai" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label required" for="Input_2">Tanggal Akhir <span class="required">*</span></label>                
                <div class="col-md-2">
                    <input id="Input_2" class="form-control dateSwift" type="text" name="tanggalAkhir" value="" readonly="readonly" data-date-format="dd-mm-yyyy">
                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Generate Xml', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>