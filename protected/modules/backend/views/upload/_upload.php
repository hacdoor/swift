<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'form-form',
        'enableAjaxValidation' => true,
        'errorMessageCssClass' => 'label label-danger',
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>

    <div class="col-md-12">

        <fieldset>
            <div class="form-group">
                <label class="col-md-2 control-label required" for="Input_1">Upload Data Customer <span class="required">*</span></label>                
                <div class="col-md-10">
                    <div class="col-md-2">
                        <div class="aUpload">
                            <a class='btn btn-primary' href='javascript:;'>
                                Choose File... <input type="file" class="inputUpload" name="fileUpload" size="40"  onchange='$("#upload-file-info").val($(this).val())'>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="wrapperUpload">
                            <input class="form-control" id="upload-file-info" value="No File Choosen..." type="text" maxlength="255" disabled="disable">
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