<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-file-alt"></span> Generate Xml
                <a href="<?php echo $this->vars['backendUrl']; ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">
                <?php $this->renderPartial('/swift/_generate',array('dateRange' => $dateRange)); ?>
            </div>
        </div>
    </div>
</div>