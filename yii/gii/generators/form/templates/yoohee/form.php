<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form-wrapper">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
	'enableAjaxValidation'=>false,
	'errorMessageCssClass'=>'label label-danger',
	'htmlOptions'=>array('class'=>'form-horizontal','role'=>'form')
)); ?>\n"; ?>

<div class="col-md-12">

<fieldset>
<?php
foreach($this->getModelAttributes() as $attribute):
	if ($attribute == 'description'): ?>
		<div class="form-group">
			<?php echo "<?php echo \$form->labelEx(\$model,'$attribute',array('class'=>'col-md-2 control-label')); ?>\n"; ?>
			<div class="col-md-10">
				<?php echo "<?php echo \$form->textarea(\$model,'$attribute',array('class'=>'form-control')); ?>\n"; ?>
				<?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>\n"; ?>
			</div>
		</div>
	<?php else:
	if ($attribute == 'body' || $attribute == 'teaser'): ?>

		<div class="form-group redactor-<?php echo $attribute; ?>">
			<?php echo "<?php echo \$form->labelEx(\$model,'$attribute',array('class'=>'col-md-2 control-label')); ?>\n"; ?>
			<div class="col-md-10">
				<?php echo "<?php \$this->widget('backend.widgets.redactorjs.Redactor',
					array(
			            'editorOptions' => array( 
			                'imageUpload' => Yii::app()->createAbsoluteUrl('backend/uploader/uploadimage'),
			                'imageGetJson' => Yii::app()->createAbsoluteUrl('backend/uploader/uploadedimages')
			             ),
						'model' => \$model, 'attribute' => '$attribute'
					)
				); ?>\n"; ?>
				<?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>\n"; ?>
			</div>
		</div>

	<?php else:
		$disabled = ($attribute == 'slug') ? true : false;
		$inputAttr = array();
		if ($disabled) {
			$inputAttr[] = "'class'=>'form-control disabled'";
			$inputAttr[] = "'readonly'=>'readonly'";
			$inputAttr[] = "'placeholder'=>'automatic'";
		} else {
			$inputAttr[] = "'class'=>'form-control'";
		}
		$inputAttr = implode(',', $inputAttr);
		$inputAttr = 'array(' . $inputAttr . ')';
	?>
		<div class="form-group">
			<?php echo "<?php echo \$form->labelEx(\$model,'$attribute',array('class'=>'col-md-2 control-label')); ?>\n"; ?>
			<div class="col-md-10">
				<?php echo "<?php echo \$form->textField(\$model,'$attribute',$inputAttr); ?>\n"; ?>
				<?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>\n"; ?>
			</div>
		</div>

	<?php endif; endif; ?>

<?php endforeach; ?>

	<div class="form-group">
		<div class="col-md-10 col-md-offset-2">
			<hr>
			<a href="<?php echo "<?php echo Yii::app()->request->baseUrl;?>"; ?>/backend/<?php echo str_replace('-', '', $this->class2id($this->modelClass)); ?>" class="btn btn-lg btn-default">Cancel</a>
			<?php echo "<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-lg btn-primary')); ?>\n"; ?>
		</div>
	</div>

</fieldset>

</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->