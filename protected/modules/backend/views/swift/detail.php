<?php
$admin = Yii::app()->user->getState('admin');
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-list"></span> Detail <?php echo $model->localId; ?>
                <a href="<?php echo $this->createUrl('konfirmasiDataTransaksi'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table list">
                            <thead>
                                <tr class="active"><th colspan="3"><h4><strong>Informasi Umum</strong></h4></th></tr>
                            <tr>
                                <th class="wrap">#</th>
                                <th style="width: 50%;">Rincian</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="list-number">1</td>
                                    <td>Local Id</td>
                                    <td><?php echo Yii::app()->util->purify($model->localId); ?></td>
                                </tr>
                                <tr>
                                    <td class="list-number">2</td>
                                    <td>Tanggal Transaksi</td>
                                    <td><?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul' => 'tanggal', 'data' => $model->tglLaporan))); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <hr/>

                        <table class="table list">
                            <thead>
                                <tr class="active"><th colspan="3"><h4><strong>Informasi Pengirim</strong></h4></th></tr>
                            <tr>
                                <th class="wrap">#</th>
                                <th style="width: 50%;">Rincian</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="list-number">1</td>
                                    <td>Tipe Pengirim</td>
                                    <td>Perorangan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-flag"></span> Summary</div>
                        <div class="panel-body">
                            <p>Info yang masih kosong :</p>
                            <ol class="listNumber">
                                <li>Local Id</li>
                                <li>Tanggal Transaksi</li>
                                <li>Nasabah Pengirim</li>
                                <li>Nasabah Penerima</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>