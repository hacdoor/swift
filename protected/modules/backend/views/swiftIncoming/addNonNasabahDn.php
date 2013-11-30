<?php
/* @var $this SwiftController */
/* @var $model Swift */

$this->breadcrumbs = array(
    'Swifts' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
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
                <span class="icon-plus"></span> <?php echo $nonNasabahDn->isNewRecord ? 'Tambah' : 'Update'; ?> Identitas Penerima Non Nasabah Swift Incoming
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
                        'namaLengkap',
                        array(
                            'name' => 'nilaiTransaksiDalamRupiah',
                            'header' => 'Nilai Transaksi Keu (Rp)',
                            'value' => '$data->nilaiTransaksiDalamRupiah',
                            'type' => 'raw',
                        ),
                        array(
                            'name' => 'idPropinsi',
                            'header' => 'Propinsi',
                            'value' => '$data->idPropinsi0->nama',
                            'type' => 'raw',
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}',
                            'buttons' => array(
                                'update' => array(
                                    'label' => 'Edit',
                                    'url' => 'array("addPenerimaNonNasabah", "id"=>$data->swift_id, "update_id"=>$data->id)',
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
            <?php echo $this->renderPartial('_formAddNonNasabahDn', array('nonNasabahDn' => $nonNasabahDn)); ?>

        </div>
    </div>
</div>
</div>