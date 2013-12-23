<!DOCTYPE html>
<?php
$admin = Yii::app()->user->getState('admin');
$isHome = ($this->id == 'default' && $this->action->id == 'dashboard' || $this->action->id == 'error') ? true : false;
?>

<html>
    <head>

        <!-- Title Site and Meta -->

        <title><?php echo Yii::app()->setting->get('site_name'); ?></title>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo $this->vars['assetsUrl']; ?>img/favicon.gif">

        <!-- StyleSheet -->

        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/offcanvas.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/datepicker.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/datetimepicker.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/bootstrap-select.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/colorbox.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/chosen.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/daterangepicker.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/yoohee.min.css">

    </head>
    <body>

        <!-- Header and Navigation -->

        <nav class="navbar navbar-default navbar-fixed-top headerAdmin <?php echo ($isHome) ? 'shadow' : '' ?>" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <a href="<?php echo $this->vars['backendUrl']; ?>">
                    <div class="linkHead pull-left"></div>
                </a>
                <ul class="nav navbar-nav pull-right">
                    <?php if ($admin->hasPermissions('dashbord.view')): ?>
                        <li <?php if ($this->action->id === 'dashboard') : ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl']; ?>"><span class="icon-th-large"></span> Dashboard</a></li>
                    <?php endif; ?>

                    <li class="dropdown 
                    <?php
                    if ($this->id == 'negara' ||
                            $this->id == 'propinsi' ||
                            $this->id == 'kabupaten' ||
                            $this->id == 'uang' ||
                            $this->id == 'nasabahPerorangan' ||
                            $this->id == 'nasabahKorporasi') :
                        ?>active<?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-book"></span> Data Master <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if ($admin->hasPermissions('negara.view')): ?>
                                <li><a href="<?php echo $this->vars['backendUrl']; ?>negara">Kode Negara</a></li>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('uang.view')): ?>
                                <li><a href="<?php echo $this->vars['backendUrl']; ?>mata-uang">Kode Mata Uang</a></li>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('propinsi.view')): ?>
                                <li><a href="<?php echo $this->vars['backendUrl']; ?>propinsi">Kode Propinsi</a></li>
                            <?php endif; ?>
                            <?php if ($admin->hasPermissions('kabupaten.view')): ?>
                                <li><a href="<?php echo $this->vars['backendUrl']; ?>kabupaten">Kode Kabupaten</a></li>
                            <?php endif; ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-caret-right caret-sub pull-right"></i>Master Nasabah</a>
                                <ul class="dropdown-menu sub-menu">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan"><i class="caret-sub icon-caret-right pull-right"></i>Nasabah Perorangan</a>
                                        <ul class="dropdown-menu sub-menu">
                                            <?php if ($admin->hasPermissions('upload.person')): ?>
                                                <li><a href="<?php echo $this->vars['backendUrl']; ?>upload?type=person"> Import Nasabah Perorangan</a></li>
                                            <?php endif; ?>
                                            <?php if ($admin->hasPermissions('nasabahPerorangan.view')): ?>
                                                <li><a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan"> Maintain Nasabah Perorangan</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan"><i class="caret-sub icon-caret-right pull-right"></i>Nasabah Korporasi</a>
                                        <ul class="dropdown-menu sub-menu">
                                            <?php if ($admin->hasPermissions('upload.kyc')): ?>
                                                <li><a href="<?php echo $this->vars['backendUrl']; ?>upload?type=kyc"> Import Nasabah Korporasi</a></li>
                                            <?php endif; ?>
                                            <?php if ($admin->hasPermissions('nasabahKorporasi.view')): ?>
                                                <li><a href="<?php echo $this->vars['backendUrl']; ?>nasabahKorporasi"> Maintain Nasabah Korporasi</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown 
                    <?php
                    if ($this->id == 'swiftIncoming' ||
                            $this->id == 'swiftOutgoing' ||
                            $this->id == 'nonSwiftIncoming' ||
                            $this->id == 'nonSwiftOutgoing' ||
                            $this->id == 'upload') :
                        ?>active<?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-exchange"></span> Transaksi <b class="caret"></b></a>
                        <ul class="dropdown-menu">                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-right caret-sub pull-right"></i>
                                    Swift
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php if ($admin->hasPermissions('swiftIncoming.view')): ?>
                                        <li><a href="<?php echo $this->vars['backendUrl']; ?>swiftIncoming"> Incoming</a></li>
                                    <?php endif; ?>
                                    <?php if ($admin->hasPermissions('swiftOutgoing.view')): ?>
                                        <li><a href="<?php echo $this->vars['backendUrl']; ?>swiftOutgoing"> Outgoing</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>                          
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-right caret-sub pull-right"></i>
                                    Non Swift
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php if ($admin->hasPermissions('nonSwiftIncoming.view')): ?>
                                        <li><a href="<?php echo $this->vars['backendUrl']; ?>nonSwiftIncoming"> Incoming</a></li>
                                    <?php endif; ?>
                                    <?php if ($admin->hasPermissions('nonSwiftOutgoing.view')): ?>
                                        <li><a href="<?php echo $this->vars['backendUrl']; ?>nonSwiftOutgoing"> Outgoing</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <div class="divider"></div>
                            <?php if ($admin->hasPermissions('upload.trx')): ?>
                                <li><a href="<?php echo $this->vars['backendUrl']; ?>upload?type=trx">Upload Transaksi</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="dropdown 
                    <?php
                    if ($this->action->id == 'konfirmasiDataTransaksi' ||
                            $this->action->id == 'generate') :
                        ?>active<?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-external-link-sign"></span> Proses <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php if ($admin->hasPermissions('konfirmasiDataTransaksi.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/konfirmasiDataTransaksi">Konfirmasi Data Transaksi</a>
                                <?php endif; ?>
                                <?php if ($admin->hasPermissions('generate.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/generate">Generate XML File</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown 
                    <?php
                    if ($this->action->id == 'incompleteTransaksi' ||
                            $this->action->id == 'incompleteNasabahPerorangan' ||
                            $this->action->id == 'incompleteNasabahKorporasi') :
                        ?>active<?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-bullhorn"></span> Report <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php if ($admin->hasPermissions('incompleteTransaksi.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/incompleteTransaksi">Incomplete Transaksi</a>
                                <?php endif; ?>
                                <?php if ($admin->hasPermissions('incompleteNasabahPerorangan.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/incompleteNasabahPerorangan">Incomplete Nasabah Perorangan</a>
                                <?php endif; ?>
                                <?php if ($admin->hasPermissions('incompleteNasabahKorporasi.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>swift/incompleteNasabahKorporasi">Incomplete Nasabah Korporasi</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown 
                    <?php
                    if ($this->id == 'group' ||
                            $this->id == 'admin' ||
                            $this->id == 'me' ||
                            $this->id == 'company') :
                        ?>active<?php endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-cog"></span> System <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php if ($admin->hasPermissions('group.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>group">Kelompok</a>
                                <?php endif; ?>
                                <?php if ($admin->hasPermissions('admin.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin">Daftar Pengguna</a>
                                <?php endif; ?>
                                <a href="<?php echo $this->vars['backendUrl']; ?>me"><?php echo ($admin->username) ? ucwords($admin->username) : 'Me'; ?> (My Account)</a>

                                <div class="divider"></div>

                                <a href="" class="hidden">About System</a>
                                <?php if ($admin->hasPermissions('company.view')): ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>company">System Parameter</a>
                                <?php endif; ?>
                                <a href="<?php echo $this->vars['backendUrl']; ?>default/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Container -->

        <div class="container" id="main">
            <div class="row">
                <div class="col-md-12 <?php echo ($isHome) ? 'minPadding' : 'addPadding' ?>" id="content">

                    <?php if (Yii::app()->user->getFlashes(false)): ?>
                        <?php
                        $flashes = Yii::app()->user->getFlashes(false);
                        foreach ($flashes as $k => $v):
                            $msg = explode('|', $v);
                            ?>
                            <div class="alert alert-<?php echo $k; ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo CHtml::encode($msg[0]); ?></strong>
                                <p><?php echo CHtml::encode($msg[1]); ?></p>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    <?php endif; ?>

                    <?php echo $content; ?>

                    <div id="footer">
                        <p>Copyright &copy; <strong><?php echo Yii::app()->setting->get('site_name'); ?></strong>. All rights reserved.</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Javascript -->

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootbox.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootstrap.file-input.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.table.addrow.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/yoohee.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/cek_all.js"></script>

    </body>
</html>