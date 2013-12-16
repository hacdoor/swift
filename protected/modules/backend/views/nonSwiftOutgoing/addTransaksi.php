<?php
$title = $transaksi->isNewRecord ? '<span class="icon-plus"></span> Tambah' : '<span class="icon-pencil"></span> Update';
$title .= ' Non Swift Incoming';
$this->pageTitle = $title;
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<div class="row">
    <div class="col-md-12">

        <div class="pull-right infoSwift">
            <span class="itemSum btn btn-warning">
                <?php echo CHtml::encode($model->getAttributeLabel('localId')); ?>:
                <b><?php echo CHtml::encode($model->localId); ?></b>
            </span>
            <span class="itemSum btn btn-warning">
                <?php echo CHtml::encode($model->getAttributeLabel('noLtdln')); ?>:
                <b><?php echo CHtml::encode($model->noLtdln); ?></b>
            </span>
        </div>

        <!-- Header Menu -->

        <?php echo $this->renderPartial('_headerMenu', array('model' => $model, 'keterlibatanBeneficialOwner' => Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA)); ?>

        <div id="content-inner" class="noBorderTop">
            <h1 class="page-title">
                <?php echo $title; ?>
                <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>
            <div class="row">
                <?php echo $this->renderPartial('_formAddTransaksi', array('transaksi' => $transaksi)); ?>
            </div>
        </div>
    </div>
</div>