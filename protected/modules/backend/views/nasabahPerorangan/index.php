<?php
$admin = Yii::app()->user->getState('admin');
$nameSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title"><span class="icon-user"></span> Nasabah Perorangan</h1>

            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>
                                    <th class="list-number">#</th>
                                    <th>No Rekening</th>
                                    <th class="wrap">Nama Lengkap</th>
                                    <th class="wrap">Tgl Lahir</th>
                                    <th class="wrap">Kewarganegaraan</th>
                                    <th class="wrap">Pekerjaan</th>
                                    <th class="wrap">Alamat</th>
                                    <th class="wrap">Propinsi</th>
                                    <th class="wrap">Kab Kota</th>
                                    <th class="wrap">No Telp</th>
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
                                            <td><?php echo Yii::app()->util->purify($d->noRekening); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->namaLengkap); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $d->tglLahir))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => $d->kewarganegaraan))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'pekerjaan', 'data' => $d->idPekerjaan))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->alamatBuktiIdentitas); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'propinsi', 'data' => $d->idPropinsiBuktiIdentitas))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'kabupaten', 'data' => $d->idKabKotaBuktiIdentitas))); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->noTelp); ?></td>
                                            <td class="list-actions">
                                                <?php if ($admin->hasPermissions('nasabahPerorangan.update')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan/update/<?php echo $d->id; ?>" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-pencil"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('nasabahPerorangan.delete')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan/delete/<?php echo $d->id; ?>" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-trash"></span></a>
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
                    <?php if ($admin->hasPermissions('nasabahPerorangan.create')): ?>
                        <a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan/create" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Create new</a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[namaLengkap]" value="<?php echo $filters['namaLengkap']; ?>">
                                <input type="hidden" name="Filter[noRekening]" value="<?php echo $filters['noRekening']; ?>">
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
                                    <li><?php echo $sort->link('namaLengkap') ?></li>
                                    <li><?php echo $sort->link('noRekening') ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                        <div class="panel-body">
                            <form method="get" class="form-filter">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[namaLengkap]" placeholder="Nama contains ..." value="<?php echo $filters['namaLengkap']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[noRekening]" placeholder="No Rekening contains ..." value="<?php echo $filters['noRekening']; ?>">
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