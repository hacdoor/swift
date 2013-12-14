<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default" id="panel-login">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-exclamation-sign"></span> Login
            </div>
            <div class="panel-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'form-login',
                    'enableClientValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                    ),
                        ));
                ?>
                <p>Tell us who you are!</p>

                <hr>

                <div class="input-group" id="group-username">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username/Email')); ?>
                </div>
                <div class="input-group" id="group-password">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
                </div>
                <div class="checkbox" id="group-remember">
                    <label>
                        <input type="checkbox" value="1" id="LoginForm_rememberMe" name="LoginForm[rememberMe]" class="checkbox">
                        Remember me
                    </label>
                </div>

                <hr>

                <?php echo CHtml::submitButton('Log me in!', array('class' => 'btn btn-lg btn-block btn-primary')); ?>

                <?php if (Yii::app()->user->getFlashes(false)): ?>
                    <hr>
                    <?php
                    $flashes = Yii::app()->user->getFlashes(false);
                    foreach ($flashes as $k => $v):
                        $msg = explode('|', $v);
                        ?>
                        <div class="alert alert-<?php echo $k; ?>">
                            <strong><?php echo CHtml::encode($msg[0]); ?></strong>
                            <p><?php echo CHtml::encode($msg[1]); ?></p>
                        </div>
                        <?php
                    endforeach;
                    ?>
                <?php endif; ?>

                <?php if (isset($_GET['logout'])): ?>
                    <?php if ($_GET['logout'] == '1'): ?>
                        <hr>
                        <div class="alert alert-info">
                            <strong>Logged-out!</strong>
                            <p>You have been logged-out.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($_GET['denied'])): ?>
                    <?php if ($_GET['denied'] == '1'): ?>
                        <hr>
                        <div class="alert alert-danger">
                            <strong>Access Denied!</strong>
                            <p>You are not allowed to access that resource.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>