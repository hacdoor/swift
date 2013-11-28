<?php

class SettingController extends BackendController
{
	protected function beforeAction($action) {
		$this->checkAccess();
		return parent::beforeAction($action);
	}

	public function actionIndex() {
		$this->checkAccess('setting.manage');

		$data = null;
		$pages = null;
		$filters = array(
			'name' => '',
		);

		$criteria = new CDbCriteria;
		$criteria->order = Yii::app()->setting->get('default_sort');

		if (isset($_GET['Filter'])) $filters = $_GET['Filter'];
		if ($filters['name']) $criteria->addSearchCondition('name', $filters['name']);

		$dataCount = Setting::model()->count($criteria);

		$pages = new CPagination($dataCount);
		$pages->setPageSize(Yii::app()->setting->get('list_size'));
		$pages->applyLimit($criteria);

		$data = Setting::model()->findAll($criteria);

		$vars = array(
			'data' => $data,
			'pages' => $pages,
			'filters' => $filters,
		);

		$this->render('index', $vars);
	}

	public function actionUpdate($id) {
		$this->checkAccess('setting.manage');

		$model = Setting::model()->findByPk($id);

		if (!$model) {
			$this->redirect($this->vars['backendUrl'] . 'setting');
			Yii::app()->end();
		}

		if ($model->name == 'salt') {
			$this->redirect($this->vars['backendUrl'] . 'setting');
			Yii::app()->end();
		}

		if (isset($_POST['Setting'])) {
			$model->attributes = $_POST['Setting'];

			if ($model->validate()) {
				if ($model->save()) {
					// Delete setting.json file
					Yii::app()->setting->clearCache();

					// Redirect
					Yii::app()->user->setFlash('success', 'Success!|' . 'Site Setting has been updated.');
					$this->redirect($this->vars['backendUrl'] . 'setting');
				} else {
					Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Site Setting, please try again.');
				}
			} else {
				Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Site Setting, please check below for errors.');
			}
		}

		$vars = array(
			'model' => $model,
		);

		$this->render('update', $vars);
	}
}