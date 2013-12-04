<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = $nasabahPeroranganDn->isNewRecord ? 'Tambah' : 'Update';
$title .= ' Identitas Penerima Nasabah Perorangan';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Swift Incoming' => array('index'),
    Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwin', 'data' => $model->pjkBankSebagai)),
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
            ($model->pjkBankSebagai == 1) ?
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwin', 'data' => $model->pjkBankSebagai)),
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
                    array('label' => Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwin', 'data' => $model->pjkBankSebagai)),
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
                <span class="icon-plus"></span> <?php echo $title; ?> 
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="innerGrid">
                <?php echo CHtml::beginForm(); ?>

                <?php
                echo CHtml::submitButton('Delete', array('name' => 'DeleteButton', 'class' => 'btn btn-delete btn-danger',
                    'confirm' => 'Are you sure you want to permanently delete these comments?'));
                ?>

                <br/><br/>

                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'nasabah-perorangan-dn-grid',
                    'dataProvider' => $dataProvider,
                    'selectableRows' => 2,
                    'itemsCssClass' => 'table table-bordered table-striped list',
                    'enablePagination' => FALSE,
                    'enableSorting' => FALSE,
                    'emptyText' => 'Tidak ada data',
                    'template' => '{items}',
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'id' => 'selectedIds',
                        ),
                        'noRekening',
                        'namaLengkap',
                        'alamatDomisili',
                        array(
                            'name' => 'idPropinsiDomisili',
                            'header' => 'Propinsi',
                            'value' => '$data->idPropinsiDomisili0->nama',
                            'type' => 'raw',
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}',
                            'buttons' => array(
                                'update' => array(
                                    'label' => 'Edit',
                                    'url' => 'array("addPenerimaNasabahPerorangan", "id"=>$data->swift_id, "update_id"=>$data->id)',
                                ),
                            ),
                        ),
                    ),
                ));
                ?>
                <?php echo CHtml::endForm(); ?>
            </div>
            <?php echo $this->renderPartial('_formAddNasabahPeroranganDn', array('nasabahPeroranganDn' => $nasabahPeroranganDn)); ?>
        </div>
    </div>
</div>