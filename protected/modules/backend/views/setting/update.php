<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="row">
	<div class="col-md-12">
		<div id="content-inner">
			<h1 class="page-title">
				<span class="icon-pencil"></span> Update Site Setting
				<a href="<?php echo $this->vars['backendUrl']; ?>setting" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
			</h1>

			<div class="row">
				<?php $this->renderPartial('/setting/_form', array('model' => $model)); ?>
			</div>
		</div>
	</div>
</div>