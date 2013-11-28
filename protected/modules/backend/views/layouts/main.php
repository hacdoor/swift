<!DOCTYPE html>
<?php
$admin = Yii::app()->user->getState('admin');
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
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/yoohee.min.css">

    </head>
    <body>

        <!-- Header and Navigation -->

        <nav class="navbar navbar-default navbar-fixed-top headerAdmin" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav pull-right">
                    <li <?php if ($this->action->id === 'dashboard') : ?>class="active"<?php endif; ?>><a href="<?php echo $this->vars['backendUrl']; ?>"><span class="icon-th-large"></span> Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-book"></span> Data Master <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->vars['backendUrl']; ?>negara">Kode Negara</a></li>
                            <li><a href="<?php echo $this->vars['backendUrl']; ?>mata-uang">Kode Mata Uang</a></li>
                            <li><a href="<?php echo $this->vars['backendUrl']; ?>propinsi">Kode Propinsi</a></li>
                            <li><a href="<?php echo $this->vars['backendUrl']; ?>kabupaten">Kode Kabupaten</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-right caret-sub pull-right"></i>
                                    Data Nasabah
                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo $this->vars['backendUrl']; ?>nasabahPerorangan"> Nasabah Perorangan</a></li>
                                    <li><a href="<?php echo $this->vars['backendUrl']; ?>nasabahKorporasi"> Nasabah Korporasi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-exchange"></span> Transaksi <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo $this->vars['backendUrl']; ?>swift?type=SwIn">Swift, Incoming</a>
                                <a href="#">Swift, Outgoing</a>
                                <a href="#">NonSwift, Incoming</a>
                                <a href="#">NonSwift, Outgoing</a>
                                <div class="divider"></div>
                                <a href="<?php echo $this->vars['backendUrl']; ?>upload?type=cus">Upload data Customer</a>
                                <a href="<?php echo $this->vars['backendUrl']; ?>upload?type=trx">Upload Transaksi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-external-link-sign"></span> Proses <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">Konfirmasi Data Transaksi</a>
                                <a href="<?php echo $this->vars['backendUrl']; ?>swift/generatexml">Generate XML File</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $this->vars['backendUrl']; ?>"><span class="icon-bullhorn"></span> Report</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-cog"></span> System <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">System Parameter</a>
                                <a href="<?php echo $this->vars['backendUrl']; ?>admin">Daftar Pengguna</a>
                                <a href="<?php echo $this->vars['backendUrl']; ?>group">Kelompok</a>
                                <a href="<?php echo $this->vars['backendUrl']; ?>default/logout">Logout</a>

                                <div class="divider"></div>

                                <a href="<?php echo $this->vars['backendUrl']; ?>me"><?php echo ($admin->username) ? ucwords($admin->username) : 'Me'; ?></a>
                                <a href="#">About System</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Container -->

        <div class="container" id="main">
            <div class="row">
                <div class="col-md-12" id="content">

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
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/yoohee.js"></script>

    </body>
</html>