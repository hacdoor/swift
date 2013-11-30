<?php

class UangController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('uang.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('nama' => '', 'simbol' => '',);
        $data = Yii::app()->util->ahdaGrid('MataUang', $filters);

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort']
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

        $vars = array(
            'model' => $model,
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

        $vars = array(
            'model' => $model,
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

        $admin = Yii::app()->user->getState('admin');

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