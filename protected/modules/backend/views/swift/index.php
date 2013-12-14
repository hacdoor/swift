<?php
$admin = Yii::app()->user->getState('admin');
$nameSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title"><span class="icon-user"></span> <?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'swift','data' => $_GET['type']))); ?></h1>

            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>
                                    <th class="list-number">#</th>
                                    <th>Local ID</th>
                                    <th class="wrap">No Ltdln</th>
                                    <th class="wrap">Tgl Laporan</th>
                                    <th class="wrap">Nama Pjk</th>
                                    <th class="wrap">Nama Pejabat Pjk</th>
                                    <th class="wrap">Jenis Laporan</th>
                                    <th class="wrap">Pjk Bank Sebagai</th>
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
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->noLtdln); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'tanggal','data' => $d->tglLaporan))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->namaPjk); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->namaPejabatPjk); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'jenisLaporan','data' => $d->jenisLaporan))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'pjkBankSebagai','data' => $d->pjkBankSebagai))); ?></td>
                                            <td class="list-actions">
                                                <?php if ($admin->hasPermissions('swift.update')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/update/<?php echo $d->id; ?>?type=<?php echo $_GET['type']; ?>" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-pencil"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('swift.delete')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/delete/<?php echo $d->id; ?>?type=<?php echo $_GET['type']; ?>" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-trash"></span></a>
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
                        <a href="<?php echo $this->vars['backendUrl']; ?>swift/create?type=SwIn" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Create new</a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[noLtdln]" value="<?php echo $filters['noLtdln']; ?>">
                                <input type="hidden" name="Filter[localId]" value="<?php echo $filters['localId']; ?>">
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
                                <button type="button" class="btn btn-default">Sort By <?php echo ucwords($nameSort); ?></button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?php echo $sort->link('id') ?></li>
                                    <li><?php echo $sort->link('noLtdln') ?></li>
                                    <li><?php echo $sort->link('localId') ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                        <div class="panel-body">
                            <form method="get" class="form-filter">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[noLtdln]" placeholder="Nama contains ..." value="<?php echo $filters['noLtdln']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[localId]" placeholder="Kode contains ..." value="<?php echo $filters['localId']; ?>">
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