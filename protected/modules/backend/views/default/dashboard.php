<?php
$admin = Yii::app()->user->getState('admin');
?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title"><span class="icon-desktop"></span> Dashboard</h1>
            <div class="iconDashbord">
                <div class="row">
                    <div class="col-md-4">
                        <div id="container" style="width: 100%; height: 280px; margin: 0 auto;"></div>
                        <?php echo $this->renderPartial('_highchart', array('jsItems' => $jsItems)); ?>
                    </div>
                    <div class="col-md-8"><br/>
                        <div class="row">
                            <?php if ($admin->hasPermissions('admin.view')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>admin">
                                            <div class="innerIcon">
                                                <span class="icon-user"></span>
                                            </div>
                                            <h5>Daftar Pengguna</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('group.view')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>group">
                                            <div class="innerIcon">
                                                <span class="icon-group"></span>
                                            </div>
                                            <h5>Kelompok</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('company.view')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>company">
                                            <div class="innerIcon">
                                                <span class="icon-cogs"></span>
                                            </div>
                                            <h5>System Parameter</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('me.view')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>me">
                                            <div class="innerIcon">
                                                <span class="icon-user-md"></span>
                                            </div>
                                            <h5>My Account</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <br/><br/>

                        <div class="row">
                            <?php if ($admin->hasPermissions('swift.generateXml')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>swift/generate">
                                            <div class="innerIcon">
                                                <span class="icon-file"></span>
                                            </div>
                                            <h5>Generate XML</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('swift.konfirmasiDataTransaksi')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>swift/konfirmasiDataTransaksi">
                                            <div class="innerIcon">
                                                <span class="icon-adjust"></span>
                                            </div>
                                            <h5>Konfirmasi Transaksi</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('upload.trx')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>upload?type=trx">
                                            <div class="innerIcon">
                                                <span class="icon-upload"></span>
                                            </div>
                                            <h5>Upload Transaksi</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('negara.view')): ?>
                                <div class="col-md-3 col-sm-3">
                                    <div class="blockIcon">
                                        <a href="<?php echo $this->vars['backendUrl']; ?>negara">
                                            <div class="innerIcon">
                                                <span class="icon-flag"></span>
                                            </div>
                                            <h5>Data Negara</h5>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>