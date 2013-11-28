<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Upload data
                <?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'upload','data' => $_GET['type']))); ?>
            </h1>
            <div class="row">
                <?php $this->renderPartial('/upload/_upload'); ?>
            </div>
        </div>
    </div>
</div>