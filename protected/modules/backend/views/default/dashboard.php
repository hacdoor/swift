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
                    <div class="col-md-8">

                        <br/>

                        <div class="row">
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
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>system-parameter">
                                        <div class="innerIcon">
                                            <span class="icon-cogs"></span>
                                        </div>
                                        <h5>System Parameter</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>report">
                                        <div class="innerIcon">
                                            <span class="icon-bullhorn"></span>
                                        </div>
                                        <h5>Report</h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <br/><br/>

                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>generate-xml">
                                        <div class="innerIcon">
                                            <span class="icon-file"></span>
                                        </div>
                                        <h5>Generate XML</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>konfirmasi">
                                        <div class="innerIcon">
                                            <span class="icon-adjust"></span>
                                        </div>
                                        <h5>Konfirmasi Transaksi</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>upload-transaksi">
                                        <div class="innerIcon">
                                            <span class="icon-upload"></span>
                                        </div>
                                        <h5>Upload Transaksi</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="blockIcon">
                                    <a href="<?php echo $this->vars['backendUrl']; ?>upload-customer">
                                        <div class="innerIcon">
                                            <span class="icon-upload-alt"></span>
                                        </div>
                                        <h5>Upload Customer</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>