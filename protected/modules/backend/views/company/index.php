<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <?php echo Yii::app()->util->ahdaTitleGridForm(array('icon' => 'flag', 'label' => $title)) ?>
            <div class="row">
                <?php echo Yii::app()->util->ahdaGridForm($data, $pages, $actions, $data_grid) ?>
                <div class="col-md-2">
                    <?php echo Yii::app()->util->ahdaPagesGridForm('company', $pages, $filters) ?>
                    <?php echo Yii::app()->util->ahdaSortGridForm($sort, array('namaPjk', 'namaPejabatPjk')) ?>
                    <?php echo Yii::app()->util->ahdaFilterGridForm($filters) ?>
                </div>
            </div>
        </div>
    </div>
</div>