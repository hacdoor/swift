<?php

class NasabahPeroranganController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $this->checkAccess('nasabahPerorangan.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('namaLengkap' => '', 'noRekening' => '');
        $data = Yii::app()->util->ahdaGrid('NasabahPerorangan', $filters);
        $actions = array(
            'edit' => array('permission' => 'nasabahPerorangan.update', 'url' => 'nasabahPerorangan/update/'),
            'delete' => array('permission' => 'nasabahPerorangan.delete', 'url' => 'nasabahPerorangan/delete/')
        );
        $data_grid = array('noRekening', 'namaLengkap', 'tglLahir', array('relasi' => 'kewarganegaraan&modul[kewarganegaraan]'));
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => '', 'label' => 'Nasabah Perorangan')
        );

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort'],
            'actions' => $actions,
            'data_grid' => $data_grid,
            'title' => 'Nasabah Perorangan',
            'breadcrumb' => $breadcrumb
        );
        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('nasabahPerorangan.create');

        $model = new NasabahPerorangan;

        if (isset($_POST['NasabahPerorangan'])) {
            $data = $_POST['NasabahPerorangan'];
            $data['tglLahir'] = date('Y-m-d', strtotime($data['tglLahir']));
            $model->attributes = $data;
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->util->setLog('NasabahPerorangan', $model->id, 'Tambah data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New NasabahPerorangan has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating NasabahPerorangan, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating NasabahPerorangan, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => 'nasabahPerorangan', 'label' => 'Nasabah Perorangan'),
            3 => array('url' => '', 'label' => 'Buat Baru Nasabah Perorangan'),
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('nasabahPerorangan.update');

        $model = NasabahPerorangan::model()->findByPk($id);
        $old = $model->attributes;
        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
            Yii::app()->end();
        }

        if (isset($_POST['NasabahPerorangan'])) {
            $data = $_POST['NasabahPerorangan'];
            $data['tglLahir'] = date('Y-m-d', strtotime($data['tglLahir']));
            $model->attributes = $data;
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    $label = $model->attributeLabels();
                    $data_diff = array('old' => $old, 'new' => $model->attributes, 'label' => $label);
                    Yii::app()->util->setLog('NasabahPerorangan', $id, 'Edit data', $data_diff);
                    Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahPerorangan has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating NasabahPerorangan, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating NasabahPerorangan, please check below for errors.');
            }
        }
        $model->tglLahir = date('d-m-Y', strtotime($model->tglLahir));
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Nasabah'),
            2 => array('url' => 'nasabahPerorangan', 'label' => 'Nasabah Perorangan'),
            3 => array('url' => '', 'label' => 'Sunting Nasabah Perorangan'),
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('nasabahPerorangan.delete');

        $model = NasabahPerorangan::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
            Yii::app()->end();
        }

        $admin = Yii::app()->user->getState('admin');

        // Delete admin
        if ($model->delete()) {
            Yii::app()->util->setLog('NasabahPerorangan', $id, 'Hapus data');
            Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahPerorangan has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting NasabahPerorangan, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'nasabahPerorangan');
        }

        Yii::app()->end();
    }

}