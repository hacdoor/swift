<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-plus"></span> Create <?php echo Yii::app()->util->purify(Yii::app()->util->getKodeStandar(array('modul'=>'swift','data' => $_GET['type']))); ?>
                <a href="<?php echo $this->vars['backendUrl']; ?>swift?type=<?php echo $_GET['type']; ?>" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">
                <?php $this->renderPartial('/swift/_form', array(
                    'model' => $model,
                    'number' => $number,
                    'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
                    'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
                    'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn
                    )); ?>
            </div>
        </div>
    </div>
</div>