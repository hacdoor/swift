<?php
/* @var $this SwiftController */
/* @var $model Swift */
$title = $transaksi->isNewRecord ? 'Tambah' : 'Update';
$title .= ' Transaksi';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Swift Outgoing' => array('index'),
    $title,
);


$this->menu = array(
    array('label' => 'Umum', 'url' => array('umum', 'id' => $model->id)),
    array('label' => 'Identitas Pengirim',
        'items' => array(
            ($model->pjkBankSebagai == 1) ?
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwout', 'data' => $model->pjkBankSebagai)),
                'items' => array(
                    array('label' => 'Nasabah',
                        'items' => array(
                            array('label' => 'Perorangan', 'url' => array('addPengirimNasabahPerorangan', 'id' => $model->id)),
                            array('label' => 'Korporasi', 'url' => array('addPengirimNasabahKorporasi', 'id' => $model->id)),
                        ),
                    ),
                    array('label' => 'Non Nasabah', 'items' => array(
                            array('label' => '< 100 Juta', 'url' => array('addPengirimNonNasabah', 'id' => $model->id, 'is_diatas_seratus_juta'=> NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK)),
                            array('label' => '> 100 Juta', 'url' => array('addPengirimNonNasabah', 'id' => $model->id, 'is_diatas_seratus_juta'=> NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_YA)),
                        ),
                    ),
                ),
                    ) :
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwout', 'data' => $model->pjkBankSebagai)),
                'items' => array(
                    array('label' => 'Nasabah',
                        'items' => array(
                            array('label' => 'Perorangan', 'url' => array('addPengirimNasabahPerorangan', 'id' => $model->id)),
                            array('label' => 'Korporasi', 'url' => array('addPengirimNasabahKorporasi', 'id' => $model->id)),
                        ),
                    ),
                ),
                    ),
        ),
    ),
    ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) ?
            array('label' => 'Beneficial Owner',
        'items' => array(
            array('label' => 'Nasabah', 'url' => array('addBeneficialOwnerNasabah', 'id' => $model->id)),
            array('label' => 'Non Nasabah', 'url' => array('addBeneficialOwnerNonNasabah', 'id' => $model->id)),
        ),
            ) : NULL
    ,
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

                <?php echo $this->renderPartial('_formAddTransaksi', array('transaksi' => $transaksi)); ?>

            </div>
        </div>
    </div>
</div>