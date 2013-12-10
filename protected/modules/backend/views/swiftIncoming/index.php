<?php
$admin = Yii::app()->user->getState('admin');
$nameSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
$openSearch = (isset($_GET['Filter'])) ? 'style="display:block;"' : 'style="display:none;"';
$showSort = '<i class="icon-sort sortIcon pull-right"></i> ';
$title = 'Daftar Swift Incoming';
$this->pageTitle = $title;
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <?php echo Yii::app()->util->ahdaTitleGridForm(array('icon' => 'list-alt', 'label' => $title)) ?>
            <div class="row">
                <?php
//                $this->widget('ext.EDateRangePicker.EDateRangePicker', array(
//                    'id' => 'Filter_date',
//                    'name' => 'Filter[date]',
//                    'value' => date('d/m/Y'),
//                    'options' => array('arrows' => true),
//                    'htmlOptions' => array('class' => 'inputClass'),
//                ));
                ?>
                <div class="col-md-10">
                    <div class="advanceSearch hidden" <?php echo $openSearch; ?>>
                        <form method="get" class="form-filter">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="Filter[localId]" placeholder="Local Id contains ..." value="<?php echo $filters['localId']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="Filter[noLtdln]" placeholder="No LTDLN contains ..." value="<?php echo $filters['noLtdln']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'jenisLaporan', 'data' => array('name' => 'Filter[jenisLaporan]', 'value' => $filters['jenisLaporan']))) ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'swiftStatus', 'data' => array('name' => 'Filter[swiftStatus]', 'value' => $filters['swiftStatus']))) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control datepicker" type="text" name="Filter[created_start]" placeholder="Created between ..." value="<?php echo $filters['created_start']; ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control datepicker" type="text" name="Filter[created_end]" placeholder="... until ..." value="<?php // echo $filters['created_end'];                                                                                                                    ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">

                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <button class="btn btn-default btn-lg pull-right"><span class="icon icon-search"></span> Search</button>
                                </div>
                            </div>
                        </form>

                        <hr/>

                    </div>

                    <?php echo CHtml::beginForm(); ?>

                    <div class="btn-group pull-right hidden">
                        <?php if (isset($_GET['Filter']) || isset($_GET['sort'])): ?>
                            <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming" class="btn btn-default btn-lg"><span class="icon icon-refresh"></span> Reset</a>
                        <?php endif; ?>
                        <span class="btn btn-default btn-lg pull-right toggleSeach"><span class="icon icon-spinner"></span> Advance Search</span>
                    </div>

                    <div class="btn-action hidden">
                        <?php echo CHtml::submitButton('Finalize', array('name' => 'FinalizeButton', 'confirm' => 'Are you sure want to finalize this record?', 'class' => 'btn btn-lg btn-default bootip disabled', 'title' => 'Set to Finalize')); ?>
                        <?php echo CHtml::submitButton('Draft', array('name' => 'DraftButton', 'confirm' => 'Are you sure want to draft this record?', 'class' => 'btn btn-lg btn-default bootip disabled', 'title' => 'Set to Draft')); ?>
                    </div>

                    <hr class="hidden"/>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>
                                    <th id="selectedIds" class="list-number checkbox-column hidden">
                                        <input class="select-on-check-all" type="checkbox" value="1" name="selectedIds_all" id="selectedIds_all">
                                    </th>
                                    <th class="list-number">#</th>
                                    <th><?php echo $sort->link('localId', $showSort . 'Local ID') ?></th>
                                    <th><?php echo $sort->link('noLtdln', $showSort . 'No LTDLN') ?></th>
                                    <th><?php echo $sort->link('tglLaporan', $showSort . 'Tanggal Laporan') ?></th>
                                    <th><?php echo $sort->link('jenisLaporan', $showSort . 'Jenis Laporan') ?></th>
                                    <th><?php echo $sort->link('status', $showSort . 'Status') ?></th>
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
                                            <td class="list-number checkbox-column hidden">
                                                <input class="select-on-check" value="<?php echo $d->id; ?>" id="selectedIds_<?php echo $i - 1; ?>" type="checkbox" name="selectedIds[]">
                                            </td>
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

                    <?php echo CHtml::endForm(); ?>

                </div>
                <div class="col-md-2">

                    <?php if ($admin->hasPermissions('swift.create')): ?>
                        <a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming/create" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Buat Baru</a>
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
                                    <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'jenisLaporan', 'data' => array('name' => 'Filter[jenisLaporan]', 'value' => $filters['jenisLaporan'], 'class' => 'chzn-select'))) ?>
                                </div>
                                <div class="form-group">
                                    <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'swiftStatus', 'data' => array('name' => 'Filter[swiftStatus]', 'value' => $filters['swiftStatus'], 'class' => 'chzn-select'))) ?>
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
            </div>
        </div>
    </div>
</div>