<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Create <?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $_GET['type']))); ?>
                <a href="<?php echo $this->vars['backendUrl']; ?>swift?type=<?php echo $_GET['type']; ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">
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
                                            <?php echo $form->hiddenField($model, 'jenisSwift', array('value' => $model->getIdByType($_GET['type']))); ?>
                                            <?php echo $form->hiddenField($model, 'status', array('value' => Swift::STATUS_DRAFT)); ?>
                                            <br>
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
                <?php
//                $this->renderPartial('/swift/_form', array(
//                    'model' => $model,
//                    'number' => $number,
//                    'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
//                    'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
//                    'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn
//                    )); 
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#Swift_jenisLaporan').on('change', function() {
        if ($(this).val() == 1 || $(this).val() == '') {
            $("#Swift_noLtdlnKoreksi").attr('readonly','readonly');
        } else {
            $("#Swift_noLtdlnKoreksi").removeAttr('readonly');
        }
    });
</script>