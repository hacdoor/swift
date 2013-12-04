<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = $nasabahKorporasiLn->isNewRecord ? 'Tambah' : 'Update';
$title .= ' Identitas Penerima Nasabah Korporasi';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Non Swift Outgoing' => array('index'),
//    Yii::app()->util->getKodeStandar(array('modul' => 'pjkBankSebagaiSwout', 'data' => $model->pjkBankSebagai)),
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
            array('label' => 'Non Nasabah', 'items' => array(
                    array('label' => '< 100 Juta', 'url' => array('addPengirimNonNasabah', 'id' => $model->id, 'is_diatas_seratus_juta' => NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK)),
                    array('label' => '> 100 Juta', 'url' => array('addPengirimNonNasabah', 'id' => $model->id, 'is_diatas_seratus_juta' => NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_YA)),
                ),
            ),
        ),
    ),
    ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) ?
            array('label' => 'Beneficial Owner',
        'items' => array(
            array('label' => 'Nasabah', 'url' => array('addBeneficialOwnerNonNasabah', 'id' => $model->id)),
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
                <?php echo CHtml::beginForm(); ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'nasabah-perorangan-dn-grid',
                    'dataProvider' => $dataProvider,
                    'selectableRows' => 2,
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'id' => 'selectedIds',
                        ),
                        'noRekening',
                        'namaKorporasi',
                        'alamat',
                        array(
                            'name' => 'idNegara',
                            'header' => 'Propinsi',
                            'value' => '$data->idNegara0->nama',
                            'type' => 'raw',
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}',
                            'buttons' => array(
                                'update' => array(
                                    'label' => 'Edit',
                                    'url' => 'array("addPenerimaNasabahKorporasi", "id"=>$data->swift_id, "update_id"=>$data->id)',
                                ),
                            ),
                        ),
                    ),
                ));
                ?>
                <?php
                echo CHtml::submitButton('Delete', array('name' => 'DeleteButton',
                    'confirm' => 'Are you sure you want to permanently delete these comments?'));
                ?>
            </div>

            <?php echo CHtml::endForm(); ?>
            <?php echo $this->renderPartial('_formAddNasabahKorporasiLn', array('nasabahKorporasiLn' => $nasabahKorporasiLn)); ?>

        </div>
    </div>
</div>
</div>