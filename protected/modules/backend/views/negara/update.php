<?php
$admin = Yii::app()->user->getState('admin');
?>

<ol class="breadcrumb">
    <li><a href="<?php echo $this->vars['backendUrl']; ?>">Dashbord</a></li>
    <li class="active">Data Master</li>
    <li><a href="<?php echo $this->vars['backendUrl']; ?>negara">Negara</a></li>
    <li class="active">Sunting Negara</li>
</ol>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-pencil"></span> Sunting Negara
                <a href="<?php echo $this->vars['backendUrl']; ?>negara" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="row">
                <?php $this->renderPartial('/negara/_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>