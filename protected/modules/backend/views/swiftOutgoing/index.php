<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = 'Daftar Swift Outgoing';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Swift Outgoing' 
);

$this->menu = array(
    array('label' => 'New', 'url' => array('create')),
);
?>

<div class="breadcrumb">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    ));
    ?>
</div>
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
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'operations'),
                ));
                echo CHtml::submitButton('Finalize', array('name' => 'FinalizeButton',
                    'confirm' => 'Are you sure you want to finalize?'));
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'swift-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'selectableRows' => 2,
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'id' => 'selectedIds',
                        ),
                        'localId',
                        'noLtdln',
                        array(
                            'name' => 'tglLaporan',
                            'filter' => FALSE,
                            'value' => '$data->tglLaporan',
                            'type' => 'raw',
                        ),
                        array(
                            'name' => 'jenisLaporan',
                            'filter' => $model->getJenisLaporanOptions(),
                            'value' => '$data->getJenisLaporanText()',
                            'type' => 'raw',
                        ),
                        array(
                            'name' => 'status',
                            'filter' => $model->getStatusOptions(),
                            'value' => '$data->getStatusText()',
                            'type' => 'raw',
                        ),
                        /*
                          'namaPejabatPjk',
                          'jenisLaporan',
                          'pjkBankSebagai',
                          'jenisSwift',
                         */
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update} | {cetak}',
                            'buttons' => array(
                                'update' => array(
                                    'label' => 'Edit',
                                    'url' => 'array("umum", "id"=>$data->id)',
                                ),
                                'cetak' => array(
                                    'label' => 'Cetak',
                                    'imageUrl' => $this->vars['assetsUrl'] . 'img/excel_icon.png',
                                    'url' => 'Yii::app()->createUrl("cetak", array("id"=>$data->id))',
                                ),
                            ),
                        ),
                    ),
                ));
                ?>

                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>