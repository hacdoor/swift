<?php
/* @var $this SettingController */
/* @var $model Setting */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-_form-form',
	'enableAjaxValidation'=>false,
	'errorMessageCssClass'=>'label label-danger',
	'htmlOptions'=>array('class'=>'form-horizontal','role'=>'form')
)); ?>

<div class="col-md-12">

<fieldset>
		<div class="form-group">
			<?php echo $form->labelEx($model,'name',array('class'=>'col-md-2 control-label')); ?>
			<div class="col-md-10">
				<input type="text" class="form-control disabled" value="<?php echo $model->name; ?>" disabled="disabled">
			</div>
		</div>

	
		<div class="form-group">
			<?php echo $form->labelEx($model,'value',array('class'=>'col-md-2 control-label')); ?>
			<div class="col-md-10">
				<?php echo $form->textField($model,'value',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'value'); ?>
			</div>
		</div>

	

	<div class="form-group">
		<div class="col-md-10 col-md-offset-2">
			<hr>
			<a href="<?php echo Yii::app()->request->baseUrl;?>/backend/setting" class="btn btn-lg btn-default">Cancel</a>
			<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-lg btn-primary')); ?>
		</div>
	</div>

</fieldset>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->