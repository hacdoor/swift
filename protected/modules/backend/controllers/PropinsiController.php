<?php

class PropinsiController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('propinsi.view');

        $data = null;
        $pages = null;
        $filters = array(
            'nama' => '',
            'negara' => '',
        );

        $criteria = new CDbCriteria;

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['nama'])
            $criteria->addSearchCondition('nama', $filters['nama']);
        if ($filters['negara'])
            $criteria->addSearchCondition('negara_id', $filters['negara']);

        $dataCount = Propinsi::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = 'Propinsi';
        $sort->attributes = array('*');
        $sort->applyOrder($criteria);

        $data = Propinsi::model()->findAll($criteria);

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort
        );

        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('propinsi.create');

        $model = new Propinsi;

        if (isset($_POST['Propinsi'])) {
            $model->attributes = $_POST['Propinsi'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Propinsi has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'propinsi');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Propinsi, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Propinsi, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('propinsi.update');

        $model = Propinsi::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'propinsi');
            Yii::app()->end();
        }

        if (isset($_POST['Propinsi'])) {
            $model->attributes = $_POST['Propinsi'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Propinsi has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'propinsi');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Propinsi, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Propinsi, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('propinsi.delete');

        $model = Propinsi::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'propinsi');
            Yii::app()->end();
        }

        $admin = Yii::app()->user->getState('admin');

        // Delete admin
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', 'Success!|' . 'Propinsi has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'MataUang');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Propinsi, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'propinsi');
        }

        Yii::app()->end();
    }
    
    public function actiongetPropinsi($id) {
        $this->layout = false;

        $response = array();
        $d = Kabupaten::model()->findByPk($id);
        $response[] = array(
            'id' => $d->propinsi_id,
        );

        $callback = 'spin8108';
        if (isset($_GET['callback']))
            $callback = $_GET['callback'];
        header('Content-type: application/json');
        echo $callback . '(' . CJSON::encode($response) . ')';
        Yii::app()->end();
    }
}