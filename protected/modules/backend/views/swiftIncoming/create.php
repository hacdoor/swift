<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Buat Baru Swift Incoming
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="row">
                <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
            </div>
        </div>
    </div>
</div>