<!DOCTYPE html>
<html>
    <head>

        <title><?php echo Yii::app()->setting->get('site_name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo $this->vars['assetsUrl']; ?>img/favicon.gif">

        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $this->vars['assetsUrl']; ?>css/yoohee.min.css">

    </head>
    <body>

        <!-- Navigation -->

        <nav class="navbar navbar-default navbar-fixed-top header">
            <div class="navbar-header">
                <img src="<?php echo $this->vars['assetsUrl']; ?>img/bg-header.gif"/>
            </div>
        </nav>

        <!-- Container -->

        <div class="container addPadding" id="content">

            <?php echo $content; ?>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="footer">
                        <p>Copyright &copy; <strong><?php echo Yii::app()->setting->get('site_name'); ?></strong>. All rights reserved.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Javascript -->

        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->vars['assetsUrl']; ?>js/bootstrap.min.js"></script>

    </body>
</html>