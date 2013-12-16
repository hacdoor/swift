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

        // Find Swift Incoming
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWIN;
        $swiftIn = Swift::model()->findAll($criteria);

        // Find Swift Outgoing
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_SWOUT;
        $swiftOut = Swift::model()->findAll($criteria);

        // Find Swift Outgoing
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWIN;
        $nonSwiftIn = Swift::model()->findAll($criteria);

        // Find Swift Outgoing
        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = ' . Swift::TYPE_NONSWOUT;
        $nonSwiftOut = Swift::model()->findAll($criteria);

        $jsItems = array(
            array(
                'name' => 'Swift Incoming',
                'data' => array(count($swiftIn)),
            ),
            array(
                'name' => 'Swift Outgoing',
                'data' => array(count($swiftOut)),
            ),
            array(
                'name' => 'Non Swift Incoming',
                'data' => array(count($nonSwiftIn)),
            ),
            array(
                'name' => 'Non Swift Outgoing',
                'data' => array(count($nonSwiftOut)),
            )
        );

        $jsItems = json_encode($jsItems);

        $vars = array(
            'siwftIn' => $swiftIn,
            'swiftOut' => $swiftOut,
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