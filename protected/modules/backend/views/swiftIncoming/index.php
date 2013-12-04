<?php
$admin = Yii::app()->user->getState('admin');
$nameSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
?>

<ol class="breadcrumb">
    <li><a href="<?php echo $this->vars['backendUrl']; ?>">Dashbord</a></li>
    <li class="active">Swift</li>
    <li class="active">Swift Incoming</li>
</ol>
<?php
/* @var $this SwiftController */
/* @var $model Swift */

$title = 'Daftar Swift Incoming';
$this->pageTitle = $title;
$this->breadcrumbs = array(
    'Daftar Swift Incoming' 
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
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>
                                    <th class="list-number">#</th>
                                    <th>Local Id</th>
                                    <th>No. LTDLN</th>
                                    <th>Tgl Laporan</th>
                                    <th>Jenis Laporan</th>
                                    <th>Status</th>
                                    <th class="list-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentPage = $pages->currentPage + 1;
                                if ($data):
                                    ?>
                                    <?php
                                    $i = ($currentPage - 1) * $pages->pageSize;
                                    foreach ($data as $d):
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="list-number"><?php echo $i; ?>.</td>
                                            <td><?php echo Yii::app()->util->purify($d->localId); ?></td>
                                            <td><?php echo Yii::app()->util->purify($d->noLtdln); ?></td>
                                            <td><?php echo Yii::app()->dateFormatter->formatDateTime($d->tglLaporan, 'long', null); ?></td>
                                            <td><?php echo Yii::app()->util->purify($d->getJenisLaporanText()); ?></td>
                                            <td><?php echo Yii::app()->util->purify($d->getStatusText()); ?></td>
                                            <td class="list-actions">
                                                <?php if ($admin->hasPermissions('swift.update')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming/umum/<?php echo $d->id; ?>" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-pencil"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('swift.export')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming/createExcel/<?php echo $d->id; ?>" class="btn btn-xs btn-default bootip" title="Export to Excel"><span class="icon icon-file"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('swift.delete')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming/delete/<?php echo $d->id; ?>" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-trash"></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-warning">No record found.</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">

                    <?php if ($admin->hasPermissions('swift.create')): ?>
                        <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming/create" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Create new</a>
                        <hr>
                    <?php endif; ?>

                    <?php
                    if ($pages->pageCount > 1):
                        $qs = array();
                        foreach ($filters as $k => $v) {
                            $qs[] = 'Filter[' . $k . ']=' . $v;
                        }
                        $qs = implode('&', $qs);
                        ?>
                        <div class="row paginator">
                            <form method="get">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <?php
                                    $disabled = 'disabled';
                                    $goto = $currentPage - 1;
                                    if ($currentPage > 1)
                                        $disabled = '';
                                    ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 input">
                                    <input type="text" class="form-control input-sm" name="page" value="<?php echo $currentPage; ?>">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <?php
                                    $disabled = 'disabled';
                                    $goto = $currentPage + 1;
                                    if ($currentPage < $pages->pageCount)
                                        $disabled = '';
                                    ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[localId]" value="<?php echo $filters['localId']; ?>">
                                <input type="hidden" name="Filter[noLtdln]" value="<?php echo $filters['noLtdln']; ?>">
                            </form>
                        </div>
                    <?php endif; ?>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-flag"></span> Summary</div>
                        <div class="panel-body">
                            <?php echo $pages->itemCount; ?> record(s) found.<br>Showing page <?php echo $currentPage; ?> of <?php echo $pages->pageCount; ?>.
                        </div>
                    </div>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Sortir</div>
                        <div class="panel-body">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default sortLimit">Sort By <?php echo ucwords($nameSort); ?></button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?php echo $sort->link('id') ?></li>
                                    <li><?php echo $sort->link('localId') ?></li>
                                    <li><?php echo $sort->link('noLtdln') ?></li>
                                    <li><?php echo $sort->link('tglLaporan') ?></li>
                                    <li><?php echo $sort->link('jenisLaporan') ?></li>
                                    <li><?php echo $sort->link('status') ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                        <div class="panel-body">
                            <form method="get" class="form-filter">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[localId]" placeholder="Local Id contains ..." value="<?php echo $filters['localId']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[noLtdln]" placeholder="No LTDLN contains ..." value="<?php echo $filters['noLtdln']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'jenisLaporan', 'data' => array('name' => 'Filter[jenisLaporan]', 'value' => $filters['jenisLaporan']))) ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[status]" placeholder="Status contains ..." value="<?php echo $filters['status']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control datepicker" type="text" name="Filter[created_start]" placeholder="Created between ..." value="<?php echo $filters['created_start']; ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                </div>
                                <div class="form-group">
                                    <input class="form-control datepicker" type="text" name="Filter[created_end]" placeholder="... until ..." value="<?php echo $filters['created_end']; ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                </div>
                                <hr>
                                <button class="btn btn-danger btn-lg btn-block"><span class="icon icon-filter"></span> Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
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