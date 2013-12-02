<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<?php
/* @var $this SwiftController */
/* @var $model Swift */

$this->breadcrumbs = array(
    'Swifts' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Umum',
);

$this->menu = array(
    array('label' => 'Umum', 'url' => array('umum', 'id' => $model->id), 'itemOptions' => array('class' => 'active')),
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
            ($model->pjkBankSebagai == 1) ?
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagai', 'data' => $model->pjkBankSebagai)),
                'items' => array(
                    array('label' => 'Nasabah',
                        'items' => array(
                            array('label' => 'Perorangan', 'url' => array('addPenerimaNasabahPerorangan', 'id' => $model->id)),
                            array('label' => 'Korporasi', 'url' => array('addPenerimaNasabahKorporasi', 'id' => $model->id)),
                        ),
                    ),
                    array('label' => 'Non Nasabah', 'url' => array('addPenerimaNonNasabah', 'id' => $model->id)),
                ),
                    ) :
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagai', 'data' => $model->pjkBankSebagai)),
                'items' => array(
                    array('label' => 'Perorangan', 'url' => array('addPenerimaNasabahPerorangan', 'id' => $model->id)),
                    array('label' => 'Korporasi', 'url' => array('addPenerimaNasabahKorporasi', 'id' => $model->id)),
                ),
                    ),
        ),
    ),
    array('label' => 'Transaksi', 'url' => array('addTransaksi', 'id' => $model->id)),
    array('label' => 'Informasi Lainnya', 'url' => array('addInfoLain', 'id' => $model->id)),
);
?>

<?php
//$this->widget('ext.mbmenu.MbMenu', array(
//    'items' => $this->menu,
//));
?>

<div class="row">
    <div class="col-md-12">
        
        <div class="pull-right infoSwift">
            <span class="itemSum btn btn-warning">
                <?php echo CHtml::encode($model->getAttributeLabel('localId')); ?>:
                <b><?php echo CHtml::encode($model->localId); ?></b>
            </span>
            <span class="itemSum btn btn-warning">
                <?php echo CHtml::encode($model->getAttributeLabel('noLtdln')); ?>:
                <b><?php echo CHtml::encode($model->noLtdln); ?></b>
            </span>
        </div>
        
        <!-- Header Menu -->

        <?php echo $this->renderPartial('_headerMenu', array('model' => $model, 'pjkBankSebagai' => '1')); ?>

        <div id="content-inner" class="noBorderTop">
            <h1 class="page-title">
                <span class="icon-pencil"></span> Sunting Swift Incoming
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="row">
                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>