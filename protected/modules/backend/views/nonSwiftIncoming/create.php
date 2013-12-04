<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = $model->isNewRecord ? 'Tambah' : 'Update';
$title .= ' Non Swift Incoming';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Non Swift Incoming' => array('index'),
    $title,
);

$this->menu = array(
    array('label' => 'List Swift', 'url' => array('index')),
);
?>

<div class="breadcrumb">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    ));
    ?>
</div>
<?php if (Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> <?php echo $title; ?>
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">

                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>

            </div>
        </div>
    </div>
</div>