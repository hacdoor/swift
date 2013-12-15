<?php

class SwiftOutgoingController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->checkAccess('swiftOutgoing.view');

        $model = new Swift('search');
        $model->unsetAttributes();  // clear any default values
        $model->jenisSwift = Swift::TYPE_SWOUT;

        if (isset($_POST['FinalizeButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $swift = Swift::model()->findByPk($id);
                    $swift->status = Swift::STATUS_FINALIZE;
                    $swift->save();
                }
            }
        }

        if (isset($_POST['DraftButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $swift = Swift::model()->findByPk($id);
                    $swift->status = Swift::STATUS_DRAFT;
                    $swift->save();
                }
            }
        }

        $data = null;
        $pages = null;
        $filters = array(
            'localId' => '',
            'noLtdln' => '',
            'created_start' => '',
            'created_end' => '',
            'jenisLaporan' => ''
        );

        $criteria = new CDbCriteria;
        $criteria->condition = 'jenisSwift = :jeniSwift AND status = :statusSwift';
        $criteria->params = array(':jeniSwift' => Swift::TYPE_SWOUT, ':statusSwift' => Swift::STATUS_DRAFT);

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['localId'])
            $criteria->addSearchCondition('localId', $filters['localId']);
        if ($filters['noLtdln'])
            $criteria->addSearchCondition('noLtdln', $filters['noLtdln']);
        if ($filters['created_start'] || $filters['created_end'])
            $criteria->addBetweenCondition('tglLaporan', $filters['created_start'] . ' 00:00:00', $filters['created_end'] . ' 23:59:59');
        if ($filters['jenisLaporan'])
            $criteria->addInCondition('jenisLaporan', array('jenisLaporan' => $filters['jenisLaporan']));
        
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Swift Outgoing')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
            'model' => $model,
            'breadcrumb' => $breadcrumb
        );

        $this->render('index', $vars);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->checkAccess('swiftOutgoing.create');

        $model = new Swift;
        $company = Company::model()->findByPk(1);
        $model->namaPjk = $company->namaPjk;
        $model->namaPejabatPjk = $company->namaPejabatPjk;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Swift'])) {
            $model->attributes = $_POST['Swift'];
            $model->jenisSwift = Swift::TYPE_SWOUT;
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
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Buat Baru')
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
        $this->checkAccess('swiftOutgoing.umum');

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
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Sunting Swift Outgoing'),
            4 => array('url' => '', 'label' => 'Data Umum'),
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
    public function actionAddPengirimNasabahPerorangan($id) {
        $this->checkAccess('swiftOutgoing.addPengirimNasabahPerorangan');

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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Pengirim Nasabah Perorangan'),
        );

        $this->render('addNasabahPeroranganDn', array(
            'model' => $model,
            'nasabahPeroranganDn' => $nasabahPeroranganDn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPengirimNasabahKorporasi($id) {
        $this->checkAccess('swiftOutgoing.addPengirimNasabahKorporasi');

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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Pengirim Nasabah Korporasi'),
        );

        $this->render('addNasabahKorporasiDn', array(
            'model' => $model,
            'nasabahKorporasiDn' => $nasabahKorporasiDn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPengirimNonNasabah($id, $is_diatas_seratus_juta = NonNasabahDn::IS_BESAR_DARI_SERATUS_JUTA_TIDAK) {
        $this->checkAccess('swiftOutgoing.addPengirimNonNasabah');

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
            if ($nonNasabahDn->validate()) {
                if ($nonNasabahDn->save()) {
                    Yii::app()->util->setLog('NonNasabahDn', $nonNasabahDn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahDn has been updated.');
                }
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Pengirim Non Nasabah'),
        );

        $this->render('addNonNasabahDn', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddBeneficialOwnerNonNasabah($id) {
        $this->checkAccess('swiftOutgoing.addBeneficialOwnerNonNasabah');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Beneficial Owner Non Nasabah'),
        );

        $this->render('addNonNasabahBeneficialOwner', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddBeneficialOwnerNasabah($id) {
        $this->checkAccess('swiftOutgoing.addBeneficialOwnerNasabah');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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
                Yii::app()->user->setFlash('info', 'Success!|' . 'NonNasabahDn has been updated.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Beneficial Owner Nasabah'),
        );

        $this->render('addNasabahBeneficialOwner', array(
            'model' => $model,
            'nonNasabahDn' => $nonNasabahDn,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPenerimaNasabahPerorangan($id, $update_id = NULL) {
        $this->checkAccess('swiftOutgoing.addPenerimaNasabahPerorangan');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Penerima Nasabah Perorangan'),
        );

        $this->render('addNasabahPeroranganLn', array(
            'model' => $model,
            'nasabahPeroranganLn' => $nasabahPeroranganLn,
            'dataProvider' => $dataProvider,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPenerimaNasabahKorporasi($id, $update_id = NULL) {
        $this->checkAccess('swiftOutgoing.addPenerimaNasabahKorporasi');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Penerima Nasabah Korporasi'),
        );

        $this->render('addNasabahKorporasiLn', array(
            'model' => $model,
            'nasabahKorporasiLn' => $nasabahKorporasiLn,
            'dataProvider' => $dataProvider,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddPenerimaNonNasabah($id, $update_id = NULL) {
        $this->checkAccess('swiftOutgoing.addPenerimaNonNasabah');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if ($model->keterlibatanBeneficialOwner == Swift::KETERLIBATAN_BENEFICIAL_OWNER_YA) {
            if (NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id, 'keterlibatanBeneficialOwner' => NonNasabahDn::KETERLIBATAN_BENEFICIAL_OWNER_YA)) === NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Beneficial Owner wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
            }
        } else {
            if (NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
                Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Pengirim wajib di isi dulu.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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
            if ($nonNasabahLn->validate()) {
                if ($nonNasabahLn->save()) {
                    Yii::app()->util->setLog('NonNasabahLn', $nonNasabahLn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'NonNasabahLn has been updated.');
                }
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Penerima Non Nasabah'),
        );

        $this->render('addNonNasabahLn', array(
            'model' => $model,
            'nonNasabahLn' => $nonNasabahLn,
            'dataProvider' => $dataProvider,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddTransaksi($id) {
        $this->checkAccess('swiftOutgoing.addTransaksi');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (NasabahPeroranganLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NasabahKorporasiLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL && NonNasabahLn::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Identitas Penerima wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Transaksi'),
        );

        $this->render('addTransaksi', array(
            'model' => $model,
            'transaksi' => $transaksi,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionAddInfoLain($id) {
        $this->checkAccess('swiftOutgoing.addInfoLain');

        $model = $this->loadModel($id);

        /*
         * validate swift
         */
        if (Transaksi::model()->findByAttributes(array('swift_id' => $model->id)) == NULL) {
            Yii::app()->user->setFlash('warning', 'Warning!|' . 'Data Transaksi wajib di isi dulu.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('swiftOutgoing/umum', 'id' => $model->id));
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

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift'),
            2 => array('url' => 'swiftOutgoing', 'label' => 'Swift Outgoing'),
            3 => array('url' => '', 'label' => 'Tambah Info Lain'),
        );

        $this->render('addInfoLain', array(
            'model' => $model,
            'infoLain' => $infoLain,
            'breadcrumb' => $breadcrumb
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->checkAccess('swiftOutgoing.delete');

        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'swiftOutgoing-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}