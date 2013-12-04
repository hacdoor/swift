<?php

class NonSwiftOutgoingController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new NonSwiftForm;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NonSwiftForm'])) {
            $model->attributes = $_POST['NonSwiftForm'];
            $model->jenisSwift = Swift::TYPE_NONSWOUT;
            $model->status = Swift::STATUS_DRAFT;
            $model->noLtdln = Yii::app()->util->getNumberSwift($model->jenisSwift);
            $model->tglLaporan = date('Y-m-d', strtotime($model->tglLaporan));
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been created.');
                $this->redirect(array('umum', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUmum($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NonSwiftForm'])) {
            $model->attributes = $_POST['NonSwiftForm'];
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been created.');
            }
        }

        $this->render('umum', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionAddPengirimNasabahPerorangan($id) {
        $model = $this->loadModel($id);

        if (NasabahPeroranganDn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahPeroranganDn = NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id));
        else {
            $nasabahPeroranganDn = new NasabahPeroranganDn;
            $nasabahPeroranganDn->unsetAttributes();
        }

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

        $this->render('addNasabahPeroranganDn', array(
            'model' => $model,
            'nasabahPeroranganDn' => $nasabahPeroranganDn,
        ));
    }

    public function actionAddPengirimNasabahKorporasi($id) {
        $model = $this->loadModel($id);

        if (NasabahKorporasiDn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahKorporasiDn = NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id));
        else {
            $nasabahKorporasiDn = new NasabahKorporasiDn;
            $nasabahKorporasiDn->unsetAttributes();
        }

        if (isset($_POST['NasabahKorporasiDn'])) {
            $nasabahKorporasiDn->attributes = $_POST['NasabahKorporasiDn'];
            $nasabahKorporasiDn->swift_id = $model->id;
            if ($nasabahKorporasiDn->save()) {
                Yii::app()->util->setLog('NasabahKorporasiDn', $nasabahKorporasiDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasiDn has been updated.');
            }
        }

        $this->render('addNasabahKorporasiDn', array(
            'model' => $model,
            'nasabahKorporasiDn' => $nasabahKorporasiDn,
        ));
    }

    public function actionAddPengirimNonNasabah($id, $is_diatas_seratus_juta = NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK) {
        $model = $this->loadModel($id);

        if (NonNasabahDn::model()->countByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_TIDAK, 'isBesarDariSeratusJuta' => $is_diatas_seratus_juta)) != 0)
            $nonNasabahDn = NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_TIDAK, 'isBesarDariSeratusJuta' => $is_diatas_seratus_juta));
        else {
            $nonNasabahDn = new NonNasabahDn;
            $nonNasabahDn->unsetAttributes();
        }

        if (isset($_POST['NonNasabahDn'])) {
            $nonNasabahDn->attributes = $_POST['NonNasabahDn'];
            $nonNasabahDn->swift_id = $model->id;
            $nonNasabahDn->keterlibatanBeneficialOwner = NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_TIDAK;
            $is_diatas_seratus_juta ? $nonNasabahDn->isBesarDariSeratusJuta = NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_YA : $nonNasabahDn->isBesarDariSeratusJuta = NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK;
            if ($nonNasabahDn->save()) {
                Yii::app()->util->setLog('NonNasabahDn', $nonNasabahDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahDn has been updated.');
            }
        }

        $this->render('addNonNasabahDn', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
        ));
    }

    public function actionAddBeneficialOwnerNonNasabah($id) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
        }

        if (NonNasabahDn::model()->countByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA, 'beneficialOwnerType' => NonNasabahDn::BENEFICIAL_OWNER_TYPE_NON_NASABAH)) != 0)
            $nonNasabahDn = NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA, 'beneficialOwnerType' => NonNasabahDn::BENEFICIAL_OWNER_TYPE_NON_NASABAH));
        else {
            $nonNasabahDn = new NonNasabahDn;
            $nonNasabahDn->unsetAttributes();
        }

        if (isset($_POST['NonNasabahDn'])) {
            $nonNasabahDn->attributes = $_POST['NonNasabahDn'];
            $nonNasabahDn->swift_id = $model->id;
            $nonNasabahDn->keterlibatanBeneficialOwner = NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA;
            $nonNasabahDn->beneficialOwnerType = NonNasabahDn::BENEFICIAL_OWNER_TYPE_NON_NASABAH;
            if ($nonNasabahDn->save()) {
                Yii::app()->util->setLog('NonNasabahDn', $nonNasabahDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahDn has been updated.');
            }
        }

        $this->render('addNonNasabahBeneficialOwner', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
        ));
    }

    public function actionAddBeneficialOwnerNasabah($id) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
        }

        if (NonNasabahDn::model()->countByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA, 'beneficialOwnerType' => NonNasabahDn::BENEFICIAL_OWNER_TYPE_NASABAH)) != 0)
            $nonNasabahDn = NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA, 'beneficialOwnerType' => NonNasabahDn::BENEFICIAL_OWNER_TYPE_NASABAH));
        else {
            $nonNasabahDn = new NonNasabahDn;
            $nonNasabahDn->unsetAttributes();
        }

        if (isset($_POST['NonNasabahDn'])) {
            $nonNasabahDn->attributes = $_POST['NonNasabahDn'];
            $nonNasabahDn->swift_id = $model->id;
            $nonNasabahDn->keterlibatanBeneficialOwner = NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA;
            $nonNasabahDn->beneficialOwnerType = NonNasabahDn::BENEFICIAL_OWNER_TYPE_NASABAH;

            if ($nonNasabahDn->save()) {
                Yii::app()->util->setLog('NonNasabahDn', $nonNasabahDn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahDn has been updated.');
            }
        }

        $this->render('addNasabahBeneficialOwner', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
        ));
    }

    public function actionAddPenerimaNasabahPerorangan($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        }

        if (NasabahPeroranganLn::model()->findByPk($update_id) === NULL) {
            $nasabahPeroranganLn = new NasabahPeroranganLn;
            $nasabahPeroranganLn->unsetAttributes();
        }
        else
            $nasabahPeroranganLn = NasabahPeroranganLn::model()->findByPk($update_id);


        if (isset($_POST['NasabahPeroranganLn'])) {
            $nasabahPeroranganLn->attributes = $_POST['NasabahPeroranganLn'];
            $nasabahPeroranganLn->swift_id = $model->id;
            $nasabahPeroranganLn->tglLahir = date('Y-m-d', strtotime($nasabahPeroranganLn->tglLahir));
            if ($nasabahPeroranganLn->save()) {
                Yii::app()->util->setLog('NasabahPeroranganLn', $nasabahPeroranganLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahPeroranganLn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NasabahPeroranganLn', array(
            'criteria' => array(
                'condition' => 'swift_id=:swiftId',
                'params' => array(':swiftId' => $model->id),
            ),
            'pagination' => FALSE,
        ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nasabahPeroranganLn = NasabahPeroranganLn::model()->findByPk($id);
                    $nasabahPeroranganLn->delete();
                }
            }
        }
        $this->render('addNasabahPeroranganLn', array(
            'model' => $model,
            'nasabahPeroranganLn' => $nasabahPeroranganLn,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddPenerimaNasabahKorporasi($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        }

        if (NasabahKorporasiLn::model()->findByPk($update_id) === NULL) {
            $nasabahKorporasiLn = new NasabahKorporasiLn;
            $nasabahKorporasiLn->unsetAttributes();
        }
        else
            $nasabahKorporasiLn = NasabahKorporasiLn::model()->findByPk($update_id);

        if (isset($_POST['NasabahKorporasiLn'])) {
            $nasabahKorporasiLn->attributes = $_POST['NasabahKorporasiLn'];
            $nasabahKorporasiLn->swift_id = $model->id;
            if ($nasabahKorporasiLn->save()) {
                Yii::app()->util->setLog('NasabahKorporasiLn', $nasabahKorporasiLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NasabahKorporasiLn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NasabahKorporasiLn', array(
            'criteria' => array(
                'condition' => 'swift_id=:swiftId',
                'params' => array(':swiftId' => $model->id),
            ),
            'pagination' => FALSE,
        ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nasabahKorporasiLn = NasabahKorporasiLn::model()->findByPk($id);
                    $nasabahKorporasiLn->delete();
                }
            }
        }
        $this->render('addNasabahKorporasiLn', array(
            'model' => $model,
            'nasabahKorporasiLn' => $nasabahKorporasiLn,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddPenerimaNonNasabah($id, $update_id = NULL) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
            }
        }

        if (NonNasabahLn::model()->findByPk($update_id) === NULL) {
            $nonNasabahLn = new NonNasabahLn;
            $nonNasabahLn->unsetAttributes();
        }
        else
            $nonNasabahLn = NonNasabahLn::model()->findByPk($update_id);

        if (isset($_POST['NonNasabahLn'])) {
            $nonNasabahLn->attributes = $_POST['NonNasabahLn'];
            $nonNasabahLn->swift_id = $model->id;
            if ($nonNasabahLn->save()) {
                Yii::app()->util->setLog('NonNasabahLn', $nonNasabahLn->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahLn has been updated.');
            }
        }

        $dataProvider = new CActiveDataProvider('NonNasabahLn', array(
            'criteria' => array(
                'condition' => 'swift_id=:swiftId',
                'params' => array(':swiftId' => $model->id),
            ),
            'pagination' => FALSE,
        ));

        if (isset($_POST['DeleteButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $nonNasabahLn = NonNasabahLn::model()->findByPk($id);
                    $nonNasabahLn->delete();
                }
            }
        }

        $this->render('addNonNasabahLn', array(
            'model' => $model,
            'nonNasabahLn' => $nonNasabahLn,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddTransaksi($id) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Identitas Penerima wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
        }

        if (Transaksi::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $transaksi = Transaksi::model()->findByAttributes(array('swift_id' => $model->id));
        else {
            $transaksi = new Transaksi;
            $transaksi->unsetAttributes();
        }
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

        $this->render('addTransaksi', array(
            'model' => $model,
            'transaksi' => $transaksi,
        ));
    }

    public function actionAddInfoLain($id) {
        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (Transaksi::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('success', 'Warning!|' . 'Data Transaksi wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('nonSwiftOutgoing/umum', 'id' => $model->id));
        }

        if (InfoLain::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $infoLain = InfoLain::model()->findByAttributes(array('swift_id' => $model->id));
        else {
            $infoLain = new InfoLain;
            $infoLain->unsetAttributes();
        }

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
        $model = new Swift('search');
        $model->unsetAttributes();  // clear any default values
        $model->jenisSwift = Swift::TYPE_NONSWOUT;

        if (isset($_POST['FinalizeButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $swift = Swift::model()->findByPk($id);
                    $swift->status = Swift::STATUS_FINALIZE;
                    $swift->save();
                }
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Swift the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Swift::model('NonSwiftForm')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Swift $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nonSwiftOutgoing-form') {
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
