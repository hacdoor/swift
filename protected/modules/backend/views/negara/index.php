<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <?php echo Yii::app()->util->ahdaTitleGridForm($title) ?>
            <div class="row">
                <?php echo Yii::app()->util->ahdaGridForm($data, $pages, $actions, $data_grid) ?>
                <div class="col-md-2">
                    <?php echo Yii::app()->util->ahdaCreateGridForm('negara.create', 'negara/create') ?>
                    <hr>
                    <?php echo Yii::app()->util->ahdaPagesGridForm('negara', $pages, $filters) ?>
                    <?php echo Yii::app()->util->ahdaSortGridForm($sort, array('nama', 'kode')) ?>
                    <?php echo Yii::app()->util->ahdaFilterGridForm($filters) ?>
                </div>
            </div>
        </div>
    </div>
</div>