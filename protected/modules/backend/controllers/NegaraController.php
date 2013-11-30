<?php

class NegaraController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('negara.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('nama' => '', 'kode' => '',);
        $data = Yii::app()->util->ahdaGrid('Negara', $filters);
        $actions = array(
            'edit' => array('permission' => 'negara.update', 'url' => 'negara/update/'),
            'delete' => array('permission' => 'negara.delete', 'url' => 'negara/delete/')
        );
        $data_grid = array('nama', 'kode');
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => '', 'label' => 'Negara')
        );

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort'],
            'actions' => $actions,
            'data_grid' => $data_grid,
            'title' => 'Negara',
            'breadcrumb' => $breadcrumb
        );
        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('negara.create');

        $model = new Negara;

        if (isset($_POST['Negara'])) {
            $model->attributes = $_POST['Negara'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    Yii::app()->util->setLog('Negara', $model->id, 'Tambah data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Negara has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'negara');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Negara, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Negara, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'negara', 'label' => 'Negara'),
            2 => array('url' => '', 'label' => 'Buat baru Negara')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('negara.update');

        $model = Negara::model()->findByPk($id);
        $old = $model->attributes;
        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'negara');
            Yii::app()->end();
        }

        if (isset($_POST['Negara'])) {
            $model->attributes = $_POST['Negara'];
            if ($model->validate()) {
                if ($model->save()) {
                    // Redirect
                    $label = array('kode' => 'Kode Negara', 'nama' => 'Nama Negara');
                    $data_diff = array('old' => $old, 'new' => $model->attributes, 'label' => $label);
                    Yii::app()->util->setLog('Negara', $id, 'Edit data', $data_diff);
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Negara has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'negara');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Negara, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Negara, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Data Master'),
            1 => array('url' => 'negara', 'label' => 'Negara'),
            2 => array('url' => '', 'label' => 'Sunting Negara')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('negara.delete');

        $model = Negara::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'negara');
            Yii::app()->end();
        }

        $admin = Yii::app()->user->getState('admin');

        // Delete admin
        if ($model->delete()) {
            Yii::app()->util->setLog('Negara', $id, 'Hapus data');
            Yii::app()->user->setFlash('success', 'Success!|' . 'Negara has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'negara');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Negara, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'negara');
        }

        Yii::app()->end();
    }

    public function actionGenerateExcel() {
        $model = Negara::model()->findAll();
        Yii::app()->request->sendFile('nama_negara_' . date('dmY') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGenerateXml() {
        $model = Negara::model()->findAll();
        Yii::app()->request->sendFile('nama_negara_' . date('dmY') . '.xml', $this->renderPartial('xmlReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGenExcel() {
        $model = Negara::model()->findAll();
        $nama = array();
        foreach ($model as $d) {
            $nama[]['nama'] = $d->nama;
        }
        $header[]['nama'] = 'Nama Negara';
        $nama = array_merge($header, $nama);
        Yii::import('application.extensions.phpexcel.JPhpExcel');
        $xls = new JPhpExcel('UTF-8', false, 'Negara');
        $xls->addArray($nama);
        $xls->generateXML('nama_negara_' . date('dmY'));
    }

}