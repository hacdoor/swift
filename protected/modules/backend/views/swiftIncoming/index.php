<?php
/* @var $this SwiftController */
/* @var $model Swift */

$this->breadcrumbs = array(
    'Swifts' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'New', 'url' => array('create')),
);
?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Manage Swift Incoming
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'operations'),
                ));
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'swift-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
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
                                    'imageUrl' => Yii::app()->request->baseUrl . '/images/cetak.png',
                                    'url' => 'Yii::app()->createUrl("cetak", array("id"=>$data->id))',
                                ),
                            ),
                        ),
                    ),
                ));
                ?>

            </div>
        </div>
    </div>
</div>