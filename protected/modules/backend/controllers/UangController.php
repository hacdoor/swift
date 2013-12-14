<?php

class UangController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('uang.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('nama' => '', 'simbol' => '', 'negara_id|negara' => '');
        $data = Yii::app()->util->ahdaGrid('MataUang', $filters);
        $actions = array(
            'edit' => array('permission' => 'uang.update', 'url' => 'mata-uang/update/'),
            'delete' => array('permission' => 'uang.delete', 'url' => 'mata-uang/delete/')
        );
        $data_grid = array('nama', 'simbol', array('relasi' => 'negara_id&negara', 'field' => 'nama'));
        //$data_grid = array('nama', 'simbol', array('relasi' => 'negara_id&modul[negara]'));

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Mata Uang')
        );

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort'],
            'actions' => $actions,
            'data_grid' => $data_grid,
            'title' => 'Mata Uang',
            'breadcrumb' => $breadcrumb
        );
        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('uang.create');

        $model = new MataUang;

        if (isset($_POST['MataUang'])) {
            $model->attributes = $_POST['MataUang'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Mata Uang has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'mata-uang');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Mata Uang, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Mata Uang, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'mata-uang', 'label' => 'Mata Uang'),
            2 => array('url' => '', 'label' => 'Buat Baru Mata Uang')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('uang.update');

        $model = MataUang::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'mata-uang');
            Yii::app()->end();
        }

        if (isset($_POST['MataUang'])) {
            $model->attributes = $_POST['MataUang'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Mata Uang has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'mata-uang');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating MataUang, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Mata Uang, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'mata-uang', 'label' => 'Mata Uang'),
            2 => array('url' => '', 'label' => 'Sunting Mata Uang')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('uang.delete');

        $model = MataUang::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'mata-uang');
            Yii::app()->end();
        }

        // Delete admin
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', 'Success!|' . 'Mata Uang has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'MataUang');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Mata Uang, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'mata-uang');
        }

        Yii::app()->end();
    }

}