<div class="form-wrapper">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
        'errorMessageCssClass' => 'label label-danger',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
    ?>

    <div class="col-md-9">

        <fieldset>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'realname', array('class' => 'col-md-2 control-label')); ?>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'realname', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'realname'); ?>
                </div>
            </div>

            <!-- Inherited group permissions -->

            <?php
            $groupPerms = array();
            if (isset($model->group)):
                ?>
                <?php if ($model->group->groupPermissions): ?>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Override Group Permissions</label>
                        <div class="col-md-10">
                            <?php
                            $i = -1;
                            foreach ($model->group->groupPermissions as $mgp):
                                $i++;
                                $p = Permission::model()->findByPk($mgp->permission_id);
                                $groupPerms[] = $mgp->permission_id;
                                $wrapStart = false;
                                $wrapEnd = false;
                                if ($i % 4 == 0)
                                    $wrapStart = true;
                                if ($i % 4 == 3)
                                    $wrapEnd = true;

                                $checked = 'checked="checked"';
                                if ($model->adminPermissions) {
                                    foreach ($model->adminPermissions as $ap) {
                                        if (!$ap->allow && $ap->permission_id == $p->id) {
                                            $checked = '';
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <?php if ($wrapStart): ?><div class="row"><?php endif; ?>
                                    <div class="col-md-3">
                                        <label class="checkbox-inline <?php if ($p->description): ?>bootip<?php endif; ?>" for="group-permission-<?php echo $p->id; ?>" <?php if ($p->description): ?>title="<?php echo Yii::app()->util->purify($p->description); ?>"<?php endif; ?>>
                                            <input type="checkbox" class="checkbox" value="<?php echo $p->id; ?>" name="Admin[group_permissions][]" id="group-permission-<?php echo $p->id; ?>" <?php echo $checked; ?>>
                                            <?php echo Yii::app()->util->purify($p->name); ?>
                                        </label>
                                    </div>
                                    <?php if ($wrapEnd): ?></div><?php endif; ?>
                            <?php endforeach; ?>
                                <?php if ($i % 4 < 3): ?></div><?php endif; ?>
                        <div class="clear"></div>
                    </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <hr/>

    <!-- Permissions -->

    <?php
    foreach ($permissions as $k => $v) {
        $i = -1;
        foreach ($v as $p) {
            $i++;
            if (in_array($p->id, $groupPerms))
                unset($permissions[$k][$i]);
        }
    }
    foreach ($permissions as $k => $v) {
        if (count($v) == 0)
            unset($permissions[$k]);
    }
    ?>
    <div class="form-group permission-list">
        <label class="col-md-2 control-label">Permissions</label>
        <div class="col-md-10">
            <?php
            $i = -1;
            foreach ($permissions as $k => $v):
                ?>
                <div class="permission-list-item clearfix">
                    <?php if ($i % 4 < 3 && $i != -1): ?></div><?php endif; ?>
                <div class="row"><div class="col-md-12"><strong class="permission-group"><?php echo $k; ?></strong></div></div>
                <?php
                $i = -1;
                foreach ($v as $p):
                    $i++;
                    $wrapStart = false;
                    $wrapEnd = false;
                    if ($i % 4 == 0)
                        $wrapStart = true;
                    if ($i % 4 == 3)
                        $wrapEnd = true;

                    $checked = '';
                    foreach ($model->adminPermissions as $mg) {
                        if ($p->id == $mg->permission_id)
                            $checked = 'checked="checked"';
                    }
                    ?>
                    <?php if ($wrapStart): ?><div class="row"><?php endif; ?>
                        <div class="col-md-3">
                            <label class="checkbox-inline <?php if ($p->id == 1): ?>system-root-permission<?php endif; ?> <?php if ($p->description): ?>bootip<?php endif; ?>" for="permission-<?php echo $p->id; ?>" <?php if ($p->description): ?>title="<?php echo Yii::app()->util->purify($p->description); ?>"<?php endif; ?>>
                                <input type="checkbox" class="checkbox <?php if ($p->id == 1): ?>system-root<?php endif; ?>" value="<?php echo $p->id; ?>" name="Admin[permissions][]" id="permission-<?php echo $p->id; ?>" <?php echo $checked; ?>>
                                <?php echo Yii::app()->util->purify($p->name); ?>
                            </label>
                        </div>
                        <?php if ($wrapEnd): ?></div><?php endif; ?>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</fieldset>

</div>

<div class="col-md-3">
    <hr class="visible-xs">

    <div class="panel panel-default panel-backend" id="panel-group">
        <div class="panel-heading">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#panel-group" href="#panel-group-body"><span class="icon icon-group"></span> Group</a>
        </div>
        <div class="panel-body panel-collapse collapse" id="panel-group-body">
            <fieldset class="form">
                <?php
                $listData = Group::model()->findAll();
                $perms = Permission::model()->findAll();
                ?>
                <script type="text/javascript">
                    var permissions = new Array();
<?php foreach ($listData as $g): ?>
        permissions['<?php echo $g->id; ?>'] = new Array();
    <?php
    $i = -1;
    foreach ($g->groupPermissions as $gp):
        $i++;
        foreach ($perms as $p) {
            if ($p->id == $gp->permission_id)
                $permissionName = $p->name;
        }
        ?>
                    permissions['<?php echo $g->id; ?>'][<?php echo $i; ?>] = '<?php echo $permissionName; ?>';
    <?php endforeach; ?>
<?php endforeach; ?>
                </script>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'group_id', array('class' => 'control-label')); ?>
                    <?php echo $form->dropDownList($model, 'group_id', CHtml::listData($listData, 'id', 'name'), array('class' => 'form-control admin-group', 'empty' => '- Group')); ?>
                    <?php echo $form->error($model, 'group_id'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Permissions</label>
                    <div id="inherited-permissions"></div>
                </div>

            </fieldset>
        </div>
    </div>

    <div class="panel panel-default panel-backend" id="panel-password">
        <div class="panel-heading">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#panel-password" href="#panel-password-body"><span class="icon icon-lock"></span> Password</a>
        </div>
        <div class="panel-body panel-collapse collapse" id="panel-password-body">
            <fieldset class="form">
                <?php if ($model->id): ?>
                    <label for="toggle-password" class="checkbox-inline">
                        <input type="checkbox" name="Admin[change_password]" id="toggle-password" value="1" class="checkbox">
                        Change password
                    </label>
                <?php endif; ?>

                <div id="form-password">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'value' => '')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'confirm_password', array('class' => 'control-label')); ?>
                        <?php echo $form->passwordField($model, 'confirm_password', array('class' => 'form-control', 'value' => '')); ?>
                        <?php echo $form->error($model, 'confirm_password'); ?>
                    </div>
                </div>

            </fieldset>
        </div>
    </div>

    <div class="panel panel-default panel-backend" id="panel-publish">
        <div class="panel-heading">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#panel-publish" href="#panel-publish-body"><span class="icon icon-check"></span> Active</a>
        </div>
        <div class="panel-body panel-collapse collapse" id="panel-publish-body">
            <fieldset class="form">

                <div class="form-group">
                    <label for="Admin_is_active" class="checkbox-inline">
                        <input type="checkbox" name="Admin[is_active]" id="Admin_is_active" <?php if ($model->is_active): ?>checked="checked"<?php endif; ?> value="1">
                        Active
                    </label>
                </div>

            </fieldset>
        </div>
    </div>

</div>

<div class="col-md-12 clear form-actions">
    <hr>
    <a href="<?php echo $this->vars['backendUrl']; ?>admin" class="btn btn-lg btn-default">Cancel</a>
    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-lg btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div>