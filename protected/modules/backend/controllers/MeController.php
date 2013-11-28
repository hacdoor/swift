<?php

class MeController extends BackendController
{
	protected function beforeAction($action) {
		$this->checkAccess();
		return parent::beforeAction($action);
	}

	public function actionIndex() {
		$me = Yii::app()->user->getState('admin');

		$model = Admin::model()->findByPk($me->id);
		$userPwd = $model->password;

		if (!$model) {
			$this->redirect($this->vars['backendUrl'] . 'default/dashboard');
			Yii::app()->end();
		}

		$tstamp = date('Y-m-d H:i:s');

		if (isset($_POST['Admin'])) {
			$model->attributes = $_POST['Admin'];
			$model->update_time = $tstamp;
			$model->is_active = 1;

			$changePwd = true;
			if (!isset($_POST['Admin']['change_password'])) {
				$changePwd = false;
			} else {
				if ($_POST['Admin']['change_password'] !== '1') $changePwd = false;
			}

			if (!$changePwd) $model->password = $model->confirm_password = $userPwd;

			if ($model->validate()) {
				if ($changePwd) $model->password = $model->confirm_password = Yii::app()->util->encryptPassword($model->password);
				if ($model->save()) {
					// Redirect
					Yii::app()->user->setFlash('success', 'Success!|' . 'Account has been updated.');
				} else {
					Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating your Account, please try again.');
				}
			} else {
				Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Account, please check below for errors.');
			}
		}

		$vars = array(
			'model' => $model,
		);

		$this->render('index', $vars);
	}
}