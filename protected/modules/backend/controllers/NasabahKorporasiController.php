<?php

class NasabahKorporasiController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('nasabahKorporasi.view');

        $data = null;
        $pages = null;
        $filters = array(
            'namaKorporasi' => '',
            'noRekening' => '',
        );

        $criteria = new CDbCriteria;

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['namaKorporasi'])
            $criteria->addSearchCondition('namaKorporasi', $filters['namaKorporasi']);
        if ($filters['noRekening'])
            $criteria->addSearchCondition('noRekening', $filters['noRekening']);

        $dataCount = NasabahKorporasi::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = 'NasabahKorporasi';
        $sort->attributes = array('*');
        $sort->applyOrder($criteria);

        $data = NasabahKorporasi::model()->findAll($criteria);

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort
        );

        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('nasabahKorporasi.create');

        $model = new NasabahKorporasi;

        if (isset($_POST['NasabahKorporasi'])) {
            $model->attributes = $_POST['NasabahKorporasi'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->util->setLog('NasabahKorporasi', $model->id, 'Tambah data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New NasabahKorporasi has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating NasabahKorporasi, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating NasabahKorporasi, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('nasabahKorporasi.update');

        $model = NasabahKorporasi::model()->findByPk($id);
        $old = $model->attributes;
        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
            Yii::app()->end();
        }

        if (isset($_POST['NasabahKorporasi'])) {
            $model->attributes = $_POST['NasabahKorporasi'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    $label = $model->attributeLabels();
                    $data_diff = array('old' => $old, 'new' => $model->attributes, 'label' => $label);
                    Yii::app()->util->setLog('NasabahKorporasi', $id, 'Edit data', $data_diff);
                    Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasi has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating NasabahKorporasi, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating NasabahKorporasi, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('nasabahKorporasi.delete');

        $model = NasabahKorporasi::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
            Yii::app()->end();
        }

        $admin = Yii::app()->user->getState('admin');

        // Delete admin
        if ($model->delete()) {
            Yii::app()->util->setLog('NasabahKorporasi', $id, 'Hapus data');
            Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasi has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting NasabahKorporasi, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'nasabahKorporasi');
        }

        Yii::app()->end();
    }


}