<?php

class NasabahKorporasiController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $this->checkAccess('nasabahKorporasi.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('namaKorporasi' => '', 'noRekening' => '',);
        $data = Yii::app()->util->ahdaGrid('NasabahKorporasi', $filters);
        $actions = array(
            'edit' => array('permission' => 'nasabahKorporasi.update', 'url' => 'nasabahKorporasi/update/'),
            'delete' => array('permission' => 'nasabahKorporasi.delete', 'url' => 'nasabahKorporasi/delete/')
        );
        $data_grid = array('noRekening', 'namaKorporasi', 'idBentukBadan', 'noTelp');
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => '', 'label' => 'Nasabah Korporasi')
        );

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort'],
            'actions' => $actions,
            'data_grid' => $data_grid,
            'title' => 'Nasabah Korporasi',
            'breadcrumb' => $breadcrumb
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => 'nasabahKorporasi', 'label' => 'Nasabah Korporasi'),
            3 => array('url' => '', 'label' => 'Buat Baru Nasabah Korporasi')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => 'nasabahKorporasi', 'label' => 'Nasabah Korporasi'),
            3 => array('url' => '', 'label' => 'Sunting Nasabah Korporasi')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
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