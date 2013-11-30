<?php
/* @var $this SwiftController */
/* @var $model Swift */

$this->breadcrumbs = array(
    'Swifts' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Swift', 'url' => array('index')),
);
?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Create Swift Incoming
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">

                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>

            </div>
        </div>
    </div>
</div>