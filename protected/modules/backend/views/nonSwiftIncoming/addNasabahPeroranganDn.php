<?php
$title = $nasabahPeroranganDn->isNewRecord ? '<span class="icon-plus"></span> Tambah' : '<span class="icon-pencil"></span> Update';
$title .= ' Identitas Penerima Nasabah Perorangan';
$this->pageTitle = $title;
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

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

        <?php echo $this->renderPartial('_headerMenu', array('model' => $model)); ?>

        <div id="content-inner" class="noBorderTop">
            <h1 class="page-title">
                <?php echo $title; ?> 
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="innerGrid">
                <?php echo CHtml::beginForm(); ?>

                <?php
                echo CHtml::submitButton('Delete', array('name' => 'DeleteButton', 'class' => 'btn btn-delete btn-danger disabled',
                    'confirm' => 'Are you sure want to permanently delete this record ?'));
                ?>

                <?php if (isset($_GET['update_id'])) : ?>
                    <a href="<?php echo $this->vars['backendUrl'] . 'nonSwiftIncoming/addPenerimaNasabahPerorangan/' . $model->id; ?>" type="text" class="btn btn-default"><i class="icon-plus"></i> Tambah Penerima</a>
                <?php endif; ?>

                <br/><br/>
                
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'nasabah-perorangan-dn-grid',
                    'dataProvider' => $dataProvider,
                    'selectableRows' => 2,
                    'itemsCssClass' => 'table table-bordered table-striped list',
                    'enablePagination' => TRUE,
                    'enableSorting' => TRUE,
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

            <hr/>

            <?php echo $this->renderPartial('_formAddNasabahPeroranganDn', array('nasabahPeroranganDn' => $nasabahPeroranganDn)); ?>

        </div>
    </div>
</div>