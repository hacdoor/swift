<?php
$admin = Yii::app()->user->getState('admin');
$nameSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
$openSearch = (isset($_GET['Filter'])) ? 'style="display:block;"' : 'style="display:none;"';
$showSort = '<i class="icon-sort sortIcon pull-right"></i> ';
$title = 'Incomplete Nasabah Korporasi';
$this->pageTitle = $title;
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <?php echo Yii::app()->util->ahdaTitleGridForm(array('icon' => 'list-alt', 'label' => $title)) ?>
            <div class="row">
                <div class="col-md-10">
                    <div class="confirmList">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped list">
                                <thead>
                                    <tr>
                                        <th>No Rekening</th>
                                        <th>Nama Korporasi</th>
                                        <th>Bentuk Badan</th>
                                        <th class="list-actions">Incomplete Info</th>
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
                                                <td><?php echo Yii::app()->util->purify($d->noRekening); ?></td>
                                                <td><?php echo Yii::app()->util->purify($d->namaKorporasi); ?></td>
                                                <td><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'bentukBadanUsaha', 'data' => $d->bentukBadan))); ?></td>
                                                <td class="list-actions">
                                                    <span class="label label-warning">-</span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="alert alert-warning">No record found.</div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="col-md-2">

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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>incompleteNasabahKorporasi?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>incompleteNasabahKorporasi?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[noRekening]" value="<?php echo $filters['noRekening']; ?>">
                                <input type="hidden" name="Filter[namaKorporasi]" value="<?php echo $filters['namaKorporasi']; ?>">
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
                        <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                        <div class="panel-body">
                            <form method="get" class="form-filter">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[noRekening]" placeholder="No Rekening contains ..." value="<?php echo $filters['noRekening']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[namaKorporasi]" placeholder="Nama Korporasi contains ..." value="<?php echo $filters['namaKorporasi']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php echo Yii::app()->util->getKodeStandar(array('modul' => 'bentukBadanUsaha', 'data' => array('name' => 'Filter[bentukBadan]', 'value' => $filters['bentukBadan'], 'class' => 'chzn-select'))) ?>
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