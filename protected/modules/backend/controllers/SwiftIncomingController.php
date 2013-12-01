<?php

class SwiftIncomingController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $this->checkAccess('swift.create');
        $model = new Swift;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Swift'])) {
            $model->attributes = $_POST['Swift'];
            $model->jenisSwift = Swift::TYPE_SWIN;
            $model->status = Swift::STATUS_DRAFT;
            $model->noLtdln = Yii::app()->util->getNumberSwift($model->jenisSwift);
            $model->tglLaporan = date('Y-m-d', strtotime($model->tglLaporan));
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been created.');
                $this->redirect(array('umum', 'id' => $model->id));
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Buat Baru Swift Incoming')
        );

        $this->render('create', array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUmum($id) {
        $this->checkAccess('swift.update');
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Swift'])) {
            $model->attributes = $_POST['Swift'];
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been created.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Sunting Swift Incoming')
        );

        $this->render('umum', array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionAddPenerimaNasabahPerorangan($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        if (NasabahPeroranganDn::model()->findByPk($update_id) === NULL) {
            $nasabahPeroranganDn = new NasabahPeroranganDn;
            $nasabahPeroranganDn->unsetAttributes();
        }
        else
            $nasabahPeroranganDn = NasabahPeroranganDn::model()->findByPk($update_id);

        if (isset($_POST['NasabahPeroranganDn'])) {
            $nasabahPeroranganDn->attributes = $_POST['NasabahPeroranganDn'];
            $nasabahPeroranganDn->swift_id = $model->id;
            $nasabahPeroranganDn->tglLahir = date('Y-m-d', strtotime($nasabahPeroranganDn->tglLahir));
            if ($nasabahPeroranganDn->save()) {
                $this->refresh();
                Yii::app()->util->setLog('NasabahPeroranganDn', $nasabahPeroranganDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahPeroranganDn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NasabahPeroranganDn', array(
                    'criteria' => array(
                        'condition' => 'swift_id=:swiftId',
                        'params' => array(':swiftId' => $model->id),
                    ),
                    'pagination' => FALSE,
                ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nasabahPeroranganDn = NasabahPeroranganDn::model()->findByPk($id);
                    $nasabahPeroranganDn->delete();
                }
            }
        }
        
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Identitas Penerima Nasabah Perorangan')
        );

        $this->render('addNasabahPeroranganDn', array(
            'model' => $model,
            'nasabahPeroranganDn' => $nasabahPeroranganDn,
            'dataProvider' => $dataProvider,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPenerimaNasabahKorporasi($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        if (NasabahKorporasiDn::model()->findByPk($update_id) === NULL) {
            $nasabahKorporasiDn = new NasabahKorporasiDn;
            $nasabahKorporasiDn->unsetAttributes();
        }
        else
            $nasabahKorporasiDn = NasabahKorporasiDn::model()->findByPk($update_id);

        if (isset($_POST['NasabahKorporasiDn'])) {
            $nasabahKorporasiDn->attributes = $_POST['NasabahKorporasiDn'];
            $nasabahKorporasiDn->swift_id = $model->id;
            if ($nasabahKorporasiDn->save()) {
                Yii::app()->util->setLog('NasabahKorporasiDn', $nasabahKorporasiDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasiDn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NasabahKorporasiDn', array(
                    'criteria' => array(
                        'condition' => 'swift_id=:swiftId',
                        'params' => array(':swiftId' => $model->id),
                    ),
                    'pagination' => FALSE,
                ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nasabahKorporasiDn = NasabahKorporasiDn::model()->findByPk($id);
                    $nasabahKorporasiDn->delete();
                }
            }
        }

        $this->render('addNasabahKorporasiDn', array(
            'model' => $model,
            'nasabahKorporasiDn' => $nasabahKorporasiDn,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddPenerimaNonNasabah($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        if (NonNasabahDn::model()->findByPk($update_id) === NULL) {
            $nonNasabahDn = new NonNasabahDn;
            $nonNasabahDn->unsetAttributes();
        }
        else
            $nonNasabahDn = NonNasabahDn::model()->findByPk($update_id);

        if (isset($_POST['NonNasabahDn'])) {
            $nonNasabahDn->attributes = $_POST['NonNasabahDn'];
            $nonNasabahDn->swift_id = $model->id;
            if ($nonNasabahDn->save()) {
                Yii::app()->util->setLog('NonNasabahDn', $nonNasabahDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahDn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NonNasabahDn', array(
                    'criteria' => array(
                        'condition' => 'swift_id=:swiftId',
                        'params' => array(':swiftId' => $model->id),
                    ),
                    'pagination' => FALSE,
                ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nonNasabahDn = NonNasabahDn::model()->findByPk($id);
                    $nonNasabahDn->delete();
                }
            }
        }

        $this->render('addNonNasabahDn', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddPengirimNasabahPerorangan($id) {
        $model = $this->loadModel($id);

        if (NasabahPeroranganLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahPeroranganLn = NasabahPeroranganLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahPeroranganLn = new NasabahPeroranganLn;

        if (isset($_POST['NasabahPeroranganLn'])) {
            $nasabahPeroranganLn->attributes = $_POST['NasabahPeroranganLn'];
            $nasabahPeroranganLn->swift_id = $model->id;
            $nasabahPeroranganLn->tglLahir = date('Y-m-d', strtotime($nasabahPeroranganLn->tglLahir));
            if ($nasabahPeroranganLn->save()) {
                Yii::app()->util->setLog('NasabahPeroranganLn', $nasabahPeroranganLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahPeroranganLn has been updated.');
            }
        }
        
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Identitas Pengirim Nasabah Perorangan')
        );

        $this->render('addNasabahPeroranganLn', array(
            'model' => $model,
            'nasabahPeroranganLn' => $nasabahPeroranganLn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPengirimNasabahKorporasi($id) {
        $model = $this->loadModel($id);

        if (NasabahKorporasiLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahKorporasiLn = NasabahKorporasiLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahKorporasiLn = new NasabahKorporasiLn;

        if (isset($_POST['NasabahKorporasiLn'])) {
            $nasabahKorporasiLn->attributes = $_POST['NasabahKorporasiLn'];
            $nasabahKorporasiLn->swift_id = $model->id;
            if ($nasabahKorporasiLn->save()) {
                Yii::app()->util->setLog('NasabahKorporasiLn', $nasabahKorporasiLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasiLn has been updated.');
            }
        }

        $this->render('addNasabahKorporasiLn', array(
            'model' => $model,
            'nasabahKorporasiLn' => $nasabahKorporasiLn,
        ));
    }

    public function actionAddPengirimNonNasabah($id) {
        $model = $this->loadModel($id);

        if (NonNasabahLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nonNasabahLn = NonNasabahLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nonNasabahLn = new NonNasabahLn;

        if (isset($_POST['NonNasabahLn'])) {
            $nonNasabahLn->attributes = $_POST['NonNasabahLn'];
            $nonNasabahLn->swift_id = $model->id;
            if ($nonNasabahLn->save()) {
                Yii::app()->util->setLog('NonNasabahLn', $nonNasabahLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahLn has been updated.');
            }
        }

        $this->render('addNonNasabahLn', array(
            'model' => $model,
            'nonNasabahLn' => $nonNasabahLn,
        ));
    }

    public function actionAddTransaksi($id) {
        $model = $this->loadModel($id);

        if (Transaksi::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $transaksi = Transaksi::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $transaksi = new Transaksi;

        if (isset($_POST['Transaksi'])) {
            $transaksi->attributes = $_POST['Transaksi'];
            $transaksi->swift_id = $model->id;
            $transaksi->tglTransaksi = date('Y-m-d', strtotime($transaksi->tglTransaksi));
            $transaksi->valueDate = date('Y-m-d', strtotime($transaksi->valueDate));
            if ($transaksi->save()) {
                Yii::app()->util->setLog('Transaksi', $transaksi->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'Transaksi has been updated.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Transaksi')
        );

        $this->render('addTransaksi', array(
            'model' => $model,
            'transaksi' => $transaksi,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddInfoLain($id) {
        $model = $this->loadModel($id);

        if (InfoLain::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $infoLain = InfoLain::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $infoLain = new InfoLain;

        if (isset($_POST['Infolain'])) {
            $infoLain->attributes = $_POST['Infolain'];
            $infoLain->swift_id = $model->id;
            if ($infoLain->save()) {
                Yii::app()->util->setLog('InfoLain', $infoLain->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'InfoLain has been updated.');
            }
        }

        $this->render('addInfoLain', array(
            'model' => $model,
            'infoLain' => $infoLain,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $this->checkAccess('swift.view');

        $data = null;
        $pages = null;
        $filters = array(
            'localId' => '',
            'noLtdln' => '',
            'tglLaporan' => '',
            'jenisLaporan' => '',
            'status' => ''
        );

        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = :jeniSwift';
        $criteria->params = array(':jeniSwift' => Swift::TYPE_SWIN);

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['localId'])
            $criteria->addSearchCondition('localId', $filters['localId']);
        if ($filters['noLtdln'])
            $criteria->addSearchCondition('noLtdln', $filters['noLtdln']);
        if ($filters['tglLaporan'])
            $criteria->addSearchCondition('tglLaporan', $filters['tglLaporan']);
        if ($filters['jenisLaporan'])
            $criteria->addSearchCondition('jenisLaporan', $filters['jenisLaporan']);
        if ($filters['status'])
            $criteria->addSearchCondition('status', $filters['status']);

        $dataCount = Swift::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = 'Swift';
        $sort->attributes = array('*');
        $sort->defaultOrder = 'id DESC';
        $sort->applyOrder($criteria);

        $data = Swift::model()->findAll($criteria);

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
        );
        $this->render('index', $vars);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Swift the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Swift::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Swift $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'swift-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * List all ajax action to get dinamic kabupaten kota 
     */
    public function actionDynamicKabKotaNasabahPeroranganDnDomisili() {
        $data = Kabupaten::model()->findAll('propinsi_id=:propinsiId', array(':propinsiId' => (int) $_POST['NasabahPeroranganDn']['idPropinsiDomisili']));

        $data = CHtml::listData($data, 'id', 'nama');
        $data = CMap::mergeArray(array(440 => 'Lain-lain'), $data);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}