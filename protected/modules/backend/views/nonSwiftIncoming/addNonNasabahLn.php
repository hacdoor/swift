<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = $nonNasabahLn->isNewRecord ? 'Tambah' : 'Update';
$title .= ' Identitas Pengirim Non Nasabah';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Non Swift Incoming' => array('index'),
    $title,
);


$this->menu = array(
    array('label' => 'Umum', 'url' => array('umum', 'id' => $model->id)),
    array('label' => 'Identitas Pengirim',
        'items' => array(
            array('label' => 'Nasabah',
                'items' => array(
                    array('label' => 'Perorangan', 'url' => array('addPengirimNasabahPerorangan', 'id' => $model->id)),
                    array('label' => 'Korporasi', 'url' => array('addPengirimNasabahKorporasi', 'id' => $model->id)),
                ),
            ),
            array('label' => 'Non Nasabah', 'url' => array('addPengirimNonNasabah', 'id' => $model->id)),
        ),
    ),
    array('label' => 'Identitas Penerima',
        'items' => array(
            array('label' => 'Nasabah',
                'items' => array(
                    array('label' => 'Perorangan', 'url' => array('addPenerimaNasabahPerorangan', 'id' => $model->id)),
                    array('label' => 'Korporasi', 'url' => array('addPenerimaNasabahKorporasi', 'id' => $model->id)),
                ),
            ),
            array('label' => 'Non Nasabah', 'url' => array('addPenerimaNonNasabah', 'id' => $model->id)),
        ),
    ),
    array('label' => 'Transaksi', 'url' => array('addTransaksi', 'id' => $model->id)),
    array('label' => 'Informasi Lainnya', 'url' => array('addInfoLain', 'id' => $model->id)),
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

<?php echo CHtml::encode($model->getAttributeLabel('localId')); ?>:
<b><?php echo CHtml::encode($model->localId); ?></b>

<?php echo CHtml::encode($model->getAttributeLabel('noLtdln')); ?>:
<b><?php echo CHtml::encode($model->noLtdln); ?></b>
<?php
$this->widget('ext.mbmenu.MbMenu', array(
    'items' => $this->menu,
));
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> <?php echo $title; ?> 
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">

                <?php echo $this->renderPartial('_formAddNonNasabahLn', array('nonNasabahLn' => $nonNasabahLn)); ?>

            </div>
        </div>
    </div>
</div>