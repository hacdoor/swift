<?php

class DefaultController extends BackendController {

    protected function beforeAction($action) {
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $admin = Yii::app()->user->getState('admin');
        if ($admin)
            $this->redirect($this->vars['backendUrl'] . 'default/dashboard');

        $this->layout = 'main-login';
        $model = new AdminLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::app()->user->setFlash('info', 'Welcome!|' . 'Welcome to ' . Yii::app()->setting->get('site_name') . ' backend application. Please use the tools wisely and happy working.');
                //if (Yii::app()->user->returnUrl == $this->vars['baseUrl'])
                Yii::app()->user->setReturnUrl($this->vars['backendUrl'] . 'default/dashboard');
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('index', array('model' => $model));
    }

    public function actionDashboard() {
        $this->checkAccess('dashbord.view');

        /* Find Data Swift Harian */

        // Find Swift Incoming Harian
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWIN . ' AND tglLaporan = ' . date('Y-m-d');
        $swiftInHarian = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Harian
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWOUT . ' AND tglLaporan = ' . date('Y-m-d');
        $swiftOutHarian = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Harian
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWIN . ' AND tglLaporan = ' . date('Y-m-d');
        $nonSwiftInHarian = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Harian
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWOUT . ' AND tglLaporan = ' . date('Y-m-d');
        $nonSwiftOutHarian = Swift::model()->findAll($criteria);

        /* Find Data Swift Finalize / Confirm */

        // Find Swift Incoming Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWIN . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_FINALIZE;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $swiftInConfirm = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWOUT . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_FINALIZE;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $swiftOutConfirm = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWIN . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_FINALIZE;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $nonSwiftInConfirm = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWOUT . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_FINALIZE;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $nonSwiftOutConfirm = Swift::model()->findAll($criteria);

        /* Find Data Swift Draft */

        // Find Swift Incoming Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWIN . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_DRAFT;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $swiftInDraft = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWOUT . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_DRAFT;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $swiftOutDraft = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWIN . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_DRAFT;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $nonSwiftInDraft = Swift::model()->findAll($criteria);

        // Find Swift Outgoing Finalize / Confirm
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWOUT . ' AND YEAR(tglLaporan)=:yearLaporan AND status = ' . Swift::STATUS_DRAFT;
        $criteria->params = array(':yearLaporan' => date('Y'));
        $nonSwiftOutDraft = Swift::model()->findAll($criteria);

        $jsItems = array(
            array(
                'name' => 'Swift Incoming',
                'data' => array(count($swiftInHarian), count($swiftInConfirm), count($swiftInDraft)),
            ),
            array(
                'name' => 'Swift Outgoing',
                'data' => array(count($swiftOutHarian), count($swiftOutConfirm), count($swiftOutDraft)),
            ),
            array(
                'name' => 'Non Swift Incoming',
                'data' => array(count($nonSwiftInHarian), count($nonSwiftInConfirm), count($nonSwiftInDraft)),
            ),
            array(
                'name' => 'Non Swift Outgoing',
                'data' => array(count($nonSwiftOutHarian), count($nonSwiftOutConfirm), count($nonSwiftOutDraft)),
            )
        );

        $jsItems = json_encode($jsItems);

        $vars = array(
            'jsItems' => $jsItems
        );

        $this->render('dashboard', $vars);
    }

    public function actionForm() {
        $model = new Negara;

        $vars = array(
            'model' => $model
        );
        $this->render('form', $vars);
    }

    public function actionUpload() {
        $this->render('upload');
    }

    public function actionGetNegara() {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $negara = Negara::model()->getNegara($keyword);
            if ($negara !== array())
                echo implode("\n", $negara);
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect($this->vars['backendUrl'] . '?logout=1');
    }

    public function redirectDenied() {
        Yii::app()->user->logout();
        $this->redirect($this->vars['backendUrl'] . '?denied=1');
    }

    public function actionTest() {
        echo 'r: ' . Yii::app()->user->returnUrl . '<br>';
        echo 'b: ' . $this->vars['baseUrl'] . '<br>';
        echo 'h: ' . Yii::app()->homeUrl;
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}