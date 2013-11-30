<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title">
                <span class="icon-pencil"></span> Update Admin
                <a href="<?php echo $this->vars['backendUrl']; ?>admin" class="btn btn-xs btn-primary pull-right"><span class="icon icon-chevron-left"></span> Back</a>
            </h1>

            <div class="row">
                <?php $this->renderPartial('/admin/_form', array('model' => $model, 'permissions' => $permissions)); ?>
            </div>
        </div>
    </div>
</div>