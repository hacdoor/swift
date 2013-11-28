<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BackendController extends CController
{

	public $menu=array();

	public $breadcrumbs=array();

	public $vars = array(
		'baseUrl' => null,
		'backendUrl' => null,
		'assetsUrl' => null,
	);

	protected function beforeAction($action) {

		// Global variables
		$this->vars = array(
			'baseUrl' => Yii::app()->request->baseUrl . '/',
			'backendUrl' => Yii::app()->request->baseUrl . '/backend/',
			'assetsUrl' => $this->module->getAssetsUrl() . '/',
		);

		return parent::beforeAction($action);
	}

	protected function checkAccess($reqPerm = null) {
		$admin = Yii::app()->user->getState('admin');

		if (!$admin) {
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->request->baseUrl . '/backend?denied=1');
			Yii::app()->end();
		} else {
			if ($reqPerm !== null) {
				if (!$admin->hasPermissions($reqPerm)) {
					Yii::app()->user->logout();
					$this->redirect(Yii::app()->request->baseUrl . '/backend?denied=1');
					Yii::app()->end();
				}
			}
		}

		return true;
	}
}