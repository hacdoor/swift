<?php

class KabupatenController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('kabupaten.view');

        $data = null;
        $pages = null;
        $filters = array(
            'nama' => '',
            'propinsi' => '',
        );

        $criteria = new CDbCriteria;

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['nama'])
            $criteria->addSearchCondition('nama', $filters['nama']);
        if ($filters['propinsi'])
            $criteria->addSearchCondition('propinsi_id', $filters['propinsi']);

        $dataCount = Kabupaten::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = 'Kabupaten';
        $sort->attributes = array('*');
        $sort->applyOrder($criteria);

        $data = Kabupaten::model()->findAll($criteria);

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Kabupaten')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
            'breadcrumb' => $breadcrumb,
            'title' => 'Kabupaten'
        );

        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('kabupaten.create');

        $model = new Kabupaten;

        if (isset($_POST['Kabupaten'])) {
            $model->attributes = $_POST['Kabupaten'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Kabupaten has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'kabupaten');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Kabupaten, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Kabupaten, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'kabupaten', 'label' => 'Kabupaten'),
            2 => array('url' => '', 'label' => 'Buat Baru Kabupaten')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('kabupaten.update');

        $model = Kabupaten::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'kabupaten');
            Yii::app()->end();
        }

        if (isset($_POST['Kabupaten'])) {
            $model->attributes = $_POST['Kabupaten'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Kabupaten has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'kabupaten');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Kabupaten, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Kabupaten, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'kabupaten', 'label' => 'Kabupaten'),
            2 => array('url' => '', 'label' => 'Sunting Kabupaten')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('kabupaten.delete');

        $model = Kabupaten::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'kabupaten');
            Yii::app()->end();
        }

        // Delete admin
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', 'Success!|' . 'Kabupaten has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'MataUang');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Kabupaten, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'kabupaten');
        }

        Yii::app()->end();
    }

    public function actionGetKota($id) {
        $this->layout = false;

        $response = array();
        $criteria = new CDbCriteria;
        $criteria->addSearchCondition('propinsi_id', $id);
        $d = Kabupaten::model()->findAll($criteria);
        foreach ($d as $k) {
            $response[] = array(
                'id' => $k->id,
                'nama' => $k->nama,
            );
        }

        $callback = 'spin8108';
        if (isset($_GET['callback']))
            $callback = $_GET['callback'];
        header('Content-type: application/json');
        echo $callback . '(' . CJSON::encode($response) . ')';
        Yii::app()->end();
    }

}