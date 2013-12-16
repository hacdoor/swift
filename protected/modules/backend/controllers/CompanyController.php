<?php

class CompanyController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('company.view');

        $filters = (isset($_GET['Filter'])) ? $_GET['Filter'] : array('namaPjk' => '', 'namaPejabatPjk' => '');
        $data = Yii::app()->util->ahdaGrid('Company', $filters);
        $actions = array(
            'edit' => array('permission' => 'company.update', 'url' => 'company/update/', 'icon' => 'pencil')
        );
        $data_grid = array('namaPjk', 'namaPejabatPjk', 'trxSource', 'kycSource', 'personSource');
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => '', 'label' => 'System Parameter')
        );

        $vars = array(
            'data' => $data['data'],
            'pages' => $data['pages'],
            'filters' => $filters,
            'sort' => $data['sort'],
            'actions' => $actions,
            'data_grid' => $data_grid,
            'title' => 'System Parameter',
            'breadcrumb' => $breadcrumb
        );
        $this->render('index', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('company.update');

        $model = Company::model()->findByPk($id);
        $old = $model->attributes;
        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'company');
            Yii::app()->end();
        }

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            if ($model->validate()) {
                $model->tglAkhirData = date('Y-m-d H:i:s');
                if ($model->save()) {
                    // Redirect
                    $label = $model->attributeLabels();
                    $data_diff = array('old' => $old, 'new' => $model->attributes, 'label' => $label);
                    Yii::app()->util->setLog('Company', $id, 'Edit data', $data_diff);
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Company has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'company');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Company, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Company, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => 'company', 'label' => 'System Parameter'),
            2 => array('url' => '', 'label' => 'Sunting System Parameter')
        );

        $vars = array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

}