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
                <label class="col-md-2 control-label required" for="Input_1">Tanggal<span class="required">*</span></label>                
                <div class="col-md-3">
                    <input class="form-control rangePicker input-lg" type="text" name="date_range" placeholder="<?php echo ($dateRange) ? $dateRange : 'Date range ...'; ?>" value="" readonly="readonly" data-date-format="dd-mm-yyyy">

                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-12 clear form-actions">
        <hr>
        <a href="<?php echo $this->vars['backendUrl']; ?>" class="btn btn-lg btn-default">Cancel</a>
        <?php echo CHtml::submitButton('Generate Xml', array('class' => 'btn btn-lg btn-primary')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div>