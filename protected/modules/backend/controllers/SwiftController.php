<?php

class SwiftController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('swift.view');

        $data = null;
        $pages = null;
        $filters = array(
            'localId' => '',
            'noLtdln' => '',
        );

        $criteria = new CDbCriteria;
        $criteria->order = 'localId ASC';
        //$criteria->condition = '';

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['localId'])
            $criteria->addSearchCondition('localId', $filters['localId']);
        if ($filters['noLtdln'])
            $criteria->addSearchCondition('noLtdln', $filters['noLtdln']);
        if (isset($_GET['type']))
            $criteria->addSearchCondition('jenisSwift', Swift::model()->getIdByType($_GET['type']));

        $dataCount = Swift::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $sort = new CSort;
        $sort->modelClass = 'Negara';
        $sort->attributes = array('*');
        $sort->applyOrder($criteria);

        $data = Swift::model()->findAll($criteria);

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Swift')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
            'breadcrumb' => $breadcrumb
        );

        $this->render('index', $vars);
    }

    public function actionKonfirmasiDataTransaksi() {
        $this->checkAccess('swift.konfirmasiDataTransaksi');

        if (isset($_POST['ConfirmButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $swift = Swift::model()->findByPk($id);
                    $swift->status = Swift::STATUS_FINALIZE;
                    if ($swift->validate()) {
                        if ($swift->save()) {
                            Yii::app()->user->setFlash('success', 'Success !|' . 'Confirm success.');
                        }
                    } else {
                        Yii::app()->user->setFlash('danger', 'Warning !|' . 'Failed set to Confirm.');
                    }
                }
            }
        }

        if (isset($_POST['UnconfirmButton'])) {
            if (isset($_POST['selectedIds'])) {
                foreach ($_POST['selectedIds'] as $id) {
                    $swift = Swift::model()->findByPk($id);
                    $swift->status = Swift::STATUS_DRAFT;
                    if ($swift->validate()) {
                        if ($swift->save()) {
                            Yii::app()->user->setFlash('success', 'Success !|' . 'Unconfirm success.');
                        }
                    } else {
                        Yii::app()->user->setFlash('danger', 'Warning !|' . 'Failed set to Confirm.');
                    }
                }
            }
        }

        $data = null;
        $pages = null;
        $dataRange = (isset($_GET['date_range'])) ? $_GET['date_range'] : '';
        $filters = array(
            'localId' => '',
            'noLtdln' => '',
            'created_start' => '',
            'created_end' => '',
            'jenisLaporan' => '',
            'swiftStatus' => '',
            'date_range' => ''
        );

        $criteria = new CDbCriteria;

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['localId'])
            $criteria->addSearchCondition('localId', $filters['localId']);
        if ($filters['noLtdln'])
            $criteria->addSearchCondition('noLtdln', $filters['noLtdln']);
        if ($filters['created_start'] || $filters['created_end'])
            $criteria->addBetweenCondition('tglLaporan', $filters['created_start'] . ' 00:00:00', $filters['created_end'] . ' 23:59:59');
        if (isset($_GET['date_range']) && $_GET['date_range'] != '') {
            $dateRange = explode(' - ', $_GET['date_range']);
            $startDate = $dateRange[0];
            $endDate = $dateRange[1];
            $criteria->addBetweenCondition('tglLaporan', $startDate . ' 00:00:00', $endDate . ' 23:59:59');
        }
        if ($filters['jenisLaporan'])
            $criteria->addInCondition('jenisLaporan', array('jenisLaporan' => $filters['jenisLaporan']));
        if ($filters['swiftStatus'])
            $criteria->addInCondition('status', array('status' => $filters['swiftStatus']));

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
            0 => array('url' => '', 'label' => 'Proses'),
            1 => array('url' => '', 'label' => 'Konfirmasi Data Transaksi')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
            'breadcrumb' => $breadcrumb,
            'dateRange' => $dataRange
        );

        $this->render('konfirmasiDataTransaksi', $vars);
    }

    public function actionIncompleteTransaksi() {
        $this->checkAccess('report.incompleteTransaksi');

        $data = null;
        $pages = null;
        $dataRange = (isset($_GET['date_range'])) ? $_GET['date_range'] : '';
        $filters = array(
            'localId' => '',
            'noLtdln' => '',
            'created_start' => '',
            'created_end' => '',
            'jenisLaporan' => '',
            'swiftStatus' => '',
            'date_range' => ''
        );

        $criteria = new CDbCriteria;
        $criteria->condition = 'status = :statusIncomplete';
        $criteria->params = array(':statusIncomplete' => Swift::STATUS_DRAFT);

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['localId'])
            $criteria->addSearchCondition('localId', $filters['localId']);
        if ($filters['noLtdln'])
            $criteria->addSearchCondition('noLtdln', $filters['noLtdln']);
        if ($filters['created_start'] || $filters['created_end'])
            $criteria->addBetweenCondition('tglLaporan', $filters['created_start'] . ' 00:00:00', $filters['created_end'] . ' 23:59:59');
        if (isset($_GET['date_range']) && $_GET['date_range'] != '') {
            $dateRange = explode(' - ', $_GET['date_range']);
            $startDate = $dateRange[0];
            $endDate = $dateRange[1];
            $criteria->addBetweenCondition('tglLaporan', $startDate . ' 00:00:00', $endDate . ' 23:59:59');
        }
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
            0 => array('url' => '', 'label' => 'Report'),
            1 => array('url' => '', 'label' => 'Incomplete Transaksi')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort,
            'breadcrumb' => $breadcrumb,
            'dateRange' => $dataRange
        );

        $this->render('incompleteTransaksi', $vars);
    }

    public function actionIncompleteNasabahPerorangan() {
        $this->checkAccess('report.incompleteNasabahPerorangan');

        $data = null;
        $pages = null;
        $filters = array(
            'noRekening' => '',
            'namaLengkap' => '',
            'tglLahir_start' => '',
            'tglLahir_end' => '',
        );

        $criteria = new CDbCriteria;
        $criteria->condition = 'noRekening = "" || namaLengkap = "" || tglLahir = "" || idPekerjaan = "" || alamatBuktiIdentitas = "" || idPropinsiBuktiIdentitas = "" || kewarganegaraan = ""';

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['noRekening'])
            $criteria->addSearchCondition('noRekening', $filters['noRekening']);
        if ($filters['namaLengkap'])
            $criteria->addSearchCondition('namaLengkap', $filters['namaLengkap']);
        if ($filters['tglLahir_start'] || $filters['tglLahir_end'])
            $criteria->addBetweenCondition('tglLahir', $filters['tglLahir_start'] . ' 00:00:00', $filters['tglLahir_end'] . ' 23:59:59');

        $sort = new CSort;
        $sort->modelClass = 'NasabahPerorangan';
        $sort->attributes = array('*');
        $sort->defaultOrder = 'id DESC';
        $sort->applyOrder($criteria);

        $data = NasabahPerorangan::model()->findAll($criteria);

        $dataCount = count($data);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Report'),
            1 => array('url' => '', 'label' => 'Incomplete Nasabah Perorangan')
        );

        $vars = array(
            'sort' => $sort,
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'breadcrumb' => $breadcrumb,
        );

        $this->render('incompleteNasabahPerorangan', $vars);
    }

    public function actionIncompleteNasabahKorporasi() {
        $this->checkAccess('report.incompleteNasabahKorporasi');

        $data = null;
        $pages = null;
        $filters = array(
            'noRekening' => '',
            'namaKorporasi' => '',
            'bentukBadan' => '',
        );

        $criteria = new CDbCriteria;
        $criteria->condition = 'noRekening = "" || namaKorporasi = "" || idBentukBadan = "" || idBidangUsaha = "" || alamat = "" || idPropinsi = "" || idKabKota = ""';

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['noRekening'])
            $criteria->addSearchCondition('noRekening', $filters['noRekening']);
        if ($filters['namaKorporasi'])
            $criteria->addSearchCondition('namaKorporasi', $filters['namaKorporasi']);
        if ($filters['bentukBadan'])
            $criteria->addSearchCondition('bentukBadan', $filters['bentukBadan']);

        $sort = new CSort;
        $sort->modelClass = 'NasabahKorporasi';
        $sort->attributes = array('*');
        $sort->defaultOrder = 'id DESC';
        $sort->applyOrder($criteria);

        $data = NasabahKorporasi::model()->findAll($criteria);

        $dataCount = count($data);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Report'),
            1 => array('url' => '', 'label' => 'Incomplete Nasabah Perorangan')
        );

        $vars = array(
            'sort' => $sort,
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'breadcrumb' => $breadcrumb,
        );

        $this->render('incompleteNasabahKorporasi', $vars);
    }

    public function actionGenerate() {
        $this->checkAccess('swift.generateXml');
        $dataRange = (isset($_GET['date_range'])) ? $_GET['date_range'] : '';
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Proses'),
            1 => array('url' => '', 'label' => 'Generate XML')
        );

        $this->render('generateXml', array('breadcrumb' => $breadcrumb, 'dateRange' => $dataRange));
    }

    public function actionCreate() {
        $this->checkAccess('swift.create');

        $model = new Swift;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Swift'])) {
            $model->attributes = $_POST['Swift'];
            $model->noLtdln = Yii::app()->util->getNumberSwift($model->jenisSwift);
            $model->tglLaporan = date('Y-m-d', strtotime($model->tglLaporan));
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been created.');
                $this->redirect(array('update', 'id' => $model->id, 'type' => $model->getTypeById($model->jenisSwift)));
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => 'swift', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Buat Baru')
        );

        $this->render('create', array(
            'model' => $model,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionUpdate($id) {
        $this->checkAccess('swift.update');

        $model = $this->loadModel($id);

        if (NasabahPeroranganDn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahPeroranganDn = NasabahPeroranganDn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahPeroranganDn = new NasabahPeroranganDn;
        if (NasabahPeroranganLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahPeroranganLn = NasabahPeroranganLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahPeroranganLn = new NasabahPeroranganLn;
        if (NasabahKorporasiDn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahKorporasiDn = NasabahKorporasiDn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahKorporasiDn = new NasabahKorporasiDn;
        if (NasabahKorporasiLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nasabahKorporasiLn = NasabahKorporasiLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nasabahKorporasiLn = new NasabahKorporasiLn;
        if (NonNasabahDn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nonNasabahDn = NonNasabahDn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nonNasabahDn = new NonNasabahDn;
        if (NonNasabahLn::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $nonNasabahLn = NonNasabahLn::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $nonNasabahLn = new NonNasabahLn;
        if (Infolain::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $infoLain = Infolain::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $infoLain = new Infolain;
        if (Transaksi::model()->countByAttributes(array('swift_id' => $model->id)) != 0)
            $transaksi = Transaksi::model()->findByAttributes(array('swift_id' => $model->id));
        else
            $transaksi = new Transaksi;

        if (isset($_POST['Swift'])) {
            $model->attributes = $_POST['Swift'];
            $model->tglLaporan = date('Y-m-d', strtotime($model->tglLaporan));
            if ($model->save()) {
                Yii::app()->util->setLog(Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)), $model->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New ' . Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $model->jenisSwift)) . ' has been updated.');
            }
        }

        if ($model->jenisSwift == Swift::TYPE_SWIN) {
            if (isset($_POST['NasabahPeroranganLn'])) {
                $nasabahPeroranganLn->attributes = $_POST['NasabahPeroranganLn'];
                $nasabahPeroranganLn->swift_id = $model->id;
                $nasabahPeroranganLn->tglLahir = date('Y-m-d', strtotime($nasabahPeroranganLn->tglLahir));
                if ($nasabahPeroranganLn->save()) {
                    Yii::app()->util->setLog('Nasabah Perorangan Ln', $nasabahPeroranganLn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Nasabah Perorangan Ln has been updated.');
                }
            }
            if (isset($_POST['NasabahKorporasiLn'])) {
                $nasabahKorporasiLn->attributes = $_POST['NasabahKorporasiLn'];
                $nasabahKorporasiLn->swift_id = $model->id;
                if ($nasabahKorporasiLn->save()) {
                    Yii::app()->util->setLog('Nasabah Korporasi Ln', $nasabahPeroranganLn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Nasabah Korporasi Ln has been updated.');
                }
            }
            if (isset($_POST['NasabahPeroranganDn'])) {
                $nasabahPeroranganDn->attributes = $_POST['NasabahPeroranganDn'];
                $nasabahPeroranganDn->swift_id = $model->id;
                $nasabahPeroranganDn->tglLahir = date('Y-m-d', strtotime($nasabahPeroranganDn->tglLahir));
                if ($nasabahPeroranganDn->save()) {
                    Yii::app()->util->setLog('Nasabah Perorangan Dn', $nasabahPeroranganDn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Nasabah Perorangan Dn has been updated.');
                }
            }
            if (isset($_POST['NasabahKorporasiDn'])) {
                $nasabahKorporasiDn->attributes = $_POST['NasabahKorporasiDn'];
                $nasabahKorporasiDn->swift_id = $model->id;
                if ($nasabahKorporasiDn->save()) {
                    Yii::app()->util->setLog('Nasabah Korporasi Dn', $nasabahPeroranganDn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Nasabah Korporasi Dn has been updated.');
                }
            }
            if (isset($_POST['NonNasabahDn'])) {
                $nonNasabahDn->attributes = $_POST['NonNasabahDn'];
                $nonNasabahDn->swift_id = $model->id;
                $nonNasabahDn->keterlibatanBeneficialOwner = 1;
                $nonNasabahDn->tglLahir = date('Y-m-d', strtotime($nonNasabahDn->tglLahir));
                if ($nonNasabahDn->save()) {
                    Yii::app()->util->setLog('Non Nasabah Dn (Beneficial Owner)', $nonNasabahDn->id, 'Update data');
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Non Nasabah Dn has been updated.');
                }
            }
        } elseif ($model->jenisSwift == Swift::TYPE_SWOUT) {
            
        } elseif ($model->jenisSwift == Swift::TYPE_NONSWIN) {
            
        } elseif ($model->jenisSwift == Swift::TYPE_NONSWOUT) {
            
        }

        if (isset($_POST['Infolain'])) {
            $infoLain->attributes = $_POST['Infolain'];
            $infoLain->swift_id = $model->id;
            if ($infoLain->save()) {
                Yii::app()->util->setLog('Info Lain', $infoLain->id, 'Update data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'Info Lain has been updated.');
            }
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
            1 => array('url' => 'swift', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Sunting Swift')
        );

        $this->render('update', array(
            'model' => $model,
            'nasabahPeroranganDn' => $nasabahPeroranganDn,
            'nasabahPeroranganLn' => $nasabahPeroranganLn,
            'nasabahKorporasiDn' => $nasabahKorporasiDn,
            'nasabahKorporasiLn' => $nasabahKorporasiLn,
            'nonNasabahDn' => $nonNasabahDn,
            'nonNasabahLn' => $nonNasabahLn,
            'infoLain' => $infoLain,
            'transaksi' => $transaksi,
            'breadcrumb' => $breadcrumb
        ));
    }

    public function actionCreate__($type) {
        $this->checkAccess('swift.create');

        $model = new Swift;
        $peroranganPengirimSwIn = new NasabahPeroranganDn;
        $korporasiPengirimSwIn = new NasabahKorporasiDn;
        $nonNasabahPengirimSwIn = new NonNasabahDn;
        $number = Yii::app()->util->getNumberSwift($type);

        if (isset($_POST['Swift'])) {
            $flag = TRUE;
            $flagSave = TRUE;

            $nasabahPengirimSwIn = new NasabahPengirimSwIn;
            $identitasPengirimSwIn = new IdentitasPengirimSwIn;

            $jenisPost = $_POST['type'];
            $jenisPengirim = $jenisPost['pengirim'];
            $jenisNasabah = $jenisPost['nasabah'];

            $data = $_POST['Swift'];
            $model->attributes = $data;
            $model->tglLaporan = date('Y-m-d', strtotime($data['tglLaporan']));
            $model->jenisLaporan = 1;
            $model->jenisSwift = 1;

            if ($model->validate()) {
                if ($jenisPengirim == 1) {
                    if ($jenisNasabah == 1) {
                        $data = $_POST['PeroranganPengirimSwIn'];
                        $peroranganPengirimSwIn->attributes = $data;
                        $peroranganPengirimSwIn->tglLahir = date('Y-m-d', strtotime($data['tglLahir']));
                        if (!$peroranganPengirimSwIn->validate()) {
                            $flag = false;
                        }
                    } else {
                        $data = $_POST['KorporasiPengirimSwIn'];
                        $korporasiPengirimSwIn->attributes = $data;
                        if (!$korporasiPengirimSwIn->validate()) {
                            $flag = false;
                        }
                    }
                } else {
                    $data = $_POST['NonNasabahPengirimSwIn'];
                    $nonNasabahPengirimSwIn->attributes = $data;
                    $nonNasabahPengirimSwIn->tglLahir = date('Y-m-d', strtotime($data['tglLahir']));
                    if (!$nonNasabahPengirimSwIn->validate()) {
                        $flag = false;
                    }
                }
            } else {
                $flag = false;
            }

            if ($flag) {
                if ($model->save()) {
                    $identitasPengirimSwIn->jenis = $jenisPengirim;
                    $identitasPengirimSwIn->swift_id = $model->id;
                    if ($identitasPengirimSwIn->save()) {
                        if ($jenisPengirim == 1) {
                            $nasabahPengirimSwIn->jenis = $jenisNasabah;
                            $nasabahPengirimSwIn->identitasPengirimSwIn_id = $identitasPengirimSwIn->id;
                            if ($nasabahPengirimSwIn->save()) {
                                if ($jenisNasabah == 1) {
                                    $peroranganPengirimSwIn->nasabahPengirimSwIn_id = $nasabahPengirimSwIn->id;
                                    if ($peroranganPengirimSwIn->save()) {
                                        
                                    } else {
                                        $flagSave = false;
                                    }
                                } else {
                                    $korporasiPengirimSwIn->nasabahPengirimSwIn_id = $nasabahPengirimSwIn->id;
                                    if ($korporasiPengirimSwIn->save()) {
                                        
                                    } else {
                                        $flagSave = false;
                                    }
                                }
                            } else {
                                $flagSave = false;
                            }
                        } else {
                            $nonNasabahPengirimSwIn->identitasPengirimSwIn_id = $identitasPengirimSwIn->id;
                            if ($nonNasabahPengirimSwIn->save()) {
                                
                            } else {
                                $flagSave = false;
                            }
                        }
                    } else {
                        $flagSave = false;
                    }
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Swift Incoming, please check below for errors.');
            }

            if ($flagSave && $flag) {
                Yii::app()->util->setLog('Swift Incoming', $model->id, 'Tambah data');
                Yii::app()->user->setFlash('success', 'Success!|' . 'New Swift Incoming has been created.');
                $this->redirect($this->vars['backendUrl'] . 'swift?type=' . $type);
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => 'swift', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Buat Baru')
        );

        $vars = array(
            'model' => $model,
            'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
            'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
            'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn,
            'number' => $number,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
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

    public function actionUpdate__($id) {
        $this->checkAccess('swift.update');

        $model = Swift::model()->findByPk($id);
        $peroranganPengirimSwIn = new PeroranganPengirimSwIn;
        $korporasiPengirimSwIn = new KorporasiPengirimSwIn;
        $nonNasabahPengirimSwIn = new NonNasabahPengirimSwIn;

        $oldModel = $model->attributes;
        $oldPeroranganPengirimSwIn = $peroranganPengirimSwIn->attributes;
        $oldKorporasiPengirimSwIn = $korporasiPengirimSwIn->attributes;
        $oldNonNasabahPengirimSwIn = $nonNasabahPengirimSwIn->attributes;

        $type = $_GET['type'];

        $identitasPengirimSwIn = IdentitasPengirimSwIn::model()->find('swift_id=' . $model->id);
        if ($identitasPengirimSwIn) {
            if ($identitasPengirimSwIn->jenis == 1) {
                $nasabahPengirimSwIn = NasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                if ($nasabahPengirimSwIn->jenis == 1) {
                    $peroranganPengirimSwIn = PeroranganPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                    $oldPeroranganPengirimSwIn = $peroranganPengirimSwIn->attributes;
                } else {
                    $korporasiPengirimSwIn = KorporasiPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                    $oldKorporasiPengirimSwIn = $korporasiPengirimSwIn->attributes;
                }
            } else {
                $nonNasabahPengirimSwIn = NonNasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                $oldNonNasabahPengirimSwIn = $nonNasabahPengirimSwIn->attributes;
            }
        }

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'swift');
            Yii::app()->end();
        }

        if (isset($_POST['Swift'])) {
            $flag = TRUE;
            $flagSave = TRUE;

            $jenisPost = $_POST['type'];
            $jenisPengirim = $jenisPost['pengirim'];
            $jenisNasabah = $jenisPost['nasabah'];

            $data = $_POST['Swift'];
            $model->attributes = $data;
            $model->tglLaporan = date('Y-m-d', strtotime($data['tglLaporan']));
            $model->jenisLaporan = 1;
            $model->jenisSwift = 1;

            if ($model->validate()) {
                if ($jenisPengirim == 1) {
                    if ($jenisNasabah == 1) {
                        $data = $_POST['PeroranganPengirimSwIn'];
                        $peroranganPengirimSwIn->attributes = $data;
                        $peroranganPengirimSwIn->tglLahir = date('Y-m-d', strtotime($data['tglLahir']));
                        if ($peroranganPengirimSwIn->validate()) {
                            
                        } else {
                            $flag = false;
                        }
                    } else {
                        $data = $_POST['KorporasiPengirimSwIn'];
                        $korporasiPengirimSwIn->attributes = $data;
                        if ($korporasiPengirimSwIn->validate()) {
                            
                        } else {
                            $flag = false;
                        }
                    }
                } else {
                    $data = $_POST['NonNasabahPengirimSwIn'];
                    $nonNasabahPengirimSwIn->attributes = $data;
                    $nonNasabahPengirimSwIn->tglLahir = date('Y-m-d', strtotime($data['tglLahir']));
                    if ($nonNasabahPengirimSwIn->validate()) {
                        
                    } else {
                        $flag = false;
                    }
                }
            } else {
                $flag = false;
            }

            if ($flag) {
                if ($model->save()) {
                    $label = $model->attributeLabels();
                    $data_diff = array('old' => $oldModel, 'new' => $model->attributes, 'label' => $label);
                    Yii::app()->util->setLog('Swift Incoming', $model->id, 'Edit data', $data_diff);
                    $identitasPengirimSwIn->jenis = $jenisPengirim;
                    $identitasPengirimSwIn->swift_id = $model->id;
                    if ($identitasPengirimSwIn->save()) {
                        if ($jenisPengirim == 1) {
                            $nasabahPengirimSwIn->jenis = $jenisNasabah;
                            $nasabahPengirimSwIn->identitasPengirimSwIn_id = $identitasPengirimSwIn->id;
                            if ($nasabahPengirimSwIn->save()) {
                                if ($jenisNasabah == 1) {
                                    $peroranganPengirimSwIn->nasabahPengirimSwIn_id = $nasabahPengirimSwIn->id;
                                    if ($peroranganPengirimSwIn->save()) {
                                        $label = $peroranganPengirimSwIn->attributeLabels();
                                        $data_diff = array('old' => $oldPeroranganPengirimSwIn, 'new' => $peroranganPengirimSwIn->attributes, 'label' => $label);
                                        Yii::app()->util->setLog('Swift Incoming[Identitas Pengirim]', $model->id, 'Edit data', $data_diff);
                                    } else {
                                        $flagSave = false;
                                    }
                                } else {
                                    $korporasiPengirimSwIn->nasabahPengirimSwIn_id = $nasabahPengirimSwIn->id;
                                    if ($korporasiPengirimSwIn->save()) {
                                        $label = $korporasiPengirimSwIn->attributeLabels();
                                        $data_diff = array('old' => $oldKorporasiPengirimSwIn, 'new' => $korporasiPengirimSwIn->attributes, 'label' => $label);
                                        Yii::app()->util->setLog('Swift Incoming[Identitas Pengirim]', $model->id, 'Edit data', $data_diff);
                                    } else {
                                        $flagSave = false;
                                    }
                                }
                            } else {
                                $flagSave = false;
                            }
                        } else {
                            $nonNasabahPengirimSwIn->identitasPengirimSwIn_id = $identitasPengirimSwIn->id;
                            if ($nonNasabahPengirimSwIn->save()) {
                                $label = $nonNasabahPengirimSwIn->attributeLabels();
                                $data_diff = array('old' => $oldNonNasabahPengirimSwIn, 'new' => $nonNasabahPengirimSwIn->attributes, 'label' => $label);
                                Yii::app()->util->setLog('Swift Incoming[Identitas Pengirim]', $model->id, 'Edit data', $data_diff);
                            } else {
                                $flagSave = false;
                            }
                        }
                    } else {
                        $flagSave = false;
                    }
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Swift Incoming, please check below for errors.');
            }

            if ($flagSave && $flag) {
                Yii::app()->user->setFlash('success', 'Success!|' . 'Swift Incoming has been updated.');
                $this->redirect($this->vars['backendUrl'] . 'swift?type=' . $type);
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => 'swift', 'label' => 'Swift'),
            2 => array('url' => '', 'label' => 'Sunting Swift')
        );

        $vars = array(
            'model' => $model,
            'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
            'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
            'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('swift.delete');

        $model = Swift::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'swift');
            Yii::app()->end();
        }

        $type = $_GET['type'];
        $admin = Yii::app()->user->getState('admin');

        $t = $model->getRelated('identitasPengirimSwIns');
        $identitasPengirimSwIn = IdentitasPengirimSwIn::model()->find('swift_id=' . $model->id);
        if ($identitasPengirimSwIn) {
            if ($identitasPengirimSwIn->jenis == 1) {
                $nasabahPengirimSwIn = NasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                if ($nasabahPengirimSwIn->jenis == 1) {
                    $peroranganPengirimSwIn = PeroranganPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                    if ($peroranganPengirimSwIn)
                        $peroranganPengirimSwIn->delete();
                } else {
                    $korporasiPengirimSwIn = KorporasiPengirimSwIn::model()->find('nasabahPengirimSwIn_id=' . $nasabahPengirimSwIn->id);
                    if ($korporasiPengirimSwIn)
                        $korporasiPengirimSwIn->delete();
                }
                $nasabahPengirimSwIn->delete();
            } else {
                $nonNasabahPengirimSwIn = NonNasabahPengirimSwIn::model()->find('identitasPengirimSwIn_id=' . $identitasPengirimSwIn->id);
                if ($nonNasabahPengirimSwIn)
                    $nonNasabahPengirimSwIn->delete();
            }
            $identitasPengirimSwIn->delete();
        }
        // Delete admin
        if ($model->delete()) {
            Yii::app()->util->setLog('Swift', $id, 'Hapus data');
            Yii::app()->user->setFlash('success', 'Success!|' . 'Swift has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'swift?type=' . $_GET['type']);
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Swift, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'swift?type=' . $_GET['type']);
        }

        Yii::app()->end();
    }

    public function actionAutocomplete() {
        if (isset($_GET['term']) && ($keyword = trim($_GET['term'])) !== '') {
            $norek = NasabahPerorangan::model()->getNoRekening($keyword);
            header('Content-type: application/json');
            echo CJSON::encode($norek);
        }
    }

    public function actionRekeningKorporasi() {
        if (isset($_GET['term']) && ($keyword = trim($_GET['term'])) !== '') {
            $norek = NasabahKorporasi::model()->getNoRekening($keyword);
            header('Content-type: application/json');
            echo CJSON::encode($norek);
        }
    }

    public function actionGenerateXml() {
        $dataRange = (isset($_GET['date_range'])) ? $_GET['date_range'] : '';
        if (empty($dataRange)) {
            Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed');
            $this->redirect($this->vars['backendUrl'] . 'swift/generate');
        }
        $dateRange = explode(' - ', $_GET['date_range']);
        $startDate = $dateRange[0];
        $endDate = $dateRange[1];

        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('tglLaporan', $startDate . ' 00:00:00', $endDate . ' 23:59:59');
        $criteria->addInCondition('status', array('status' => 2));
        $model = Swift::model()->findAll($criteria);
        $dataFile = array();
        if ($model) {
            foreach ($model as $value) {
                $type = Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $value->jenisSwift));
                $filename = 'download/' . $value->localId . '-' . $type . '.xml';

                $form = Yii::app()->util->getFormXml($value);
                $xml = Yii::app()->util->genSwiftXml($form, $xml = null, $root = 'ifti', $type);

                file_put_contents($filename, $xml);
                $dataFile[] = $filename;
            }

            Yii::app()->util->actionCreatefile('SWIFTXML.zip', $dataFile);
        }else{
            Yii::app()->user->setFlash('danger', 'Error!|' . 'Data empty');
            $this->redirect($this->vars['backendUrl'] . 'swift/generate');
        }
    }

    /**
     * List all ajax action to get dinamic kabupaten kota 
     */
    public function actionDynamicNegaraNasabahPeroranganLnNegaraKewarganegaraan() {
        if ((int) $_POST['NasabahPeroranganLn']['wargaNegara'] === 1)
            $data = array(62 => 'Indonesia');
        else {
            $data = Negara::model()->findAll();
            $data = CHtml::listData($data, 'id', 'nama');
            $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        }
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionDynamicNegaraNasabahPeroranganDnNegaraKewarganegaraan() {
        if ((int) $_POST['NasabahPeroranganDn']['wargaNegara'] === 1)
            $data = array(62 => 'Indonesia');
        else {
            $data = Negara::model()->findAll();
            $data = CHtml::listData($data, 'id', 'nama');
            $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        }
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionDynamicNegaraNasabahPeroranganDnDomisili() {
        if ($_POST['NasabahPeroranganDn']['idPropinsiDomisili'] === '')
            $data = Kabupaten::model()->findAll();
        else
            $data = Kabupaten::model()->findAll('propinsi_id=:propinsiId', array(':propinsiId' => (int) $_POST['NasabahPeroranganDn']['idPropinsiDomisili']));

        $data = CHtml::listData($data, 'id', 'nama');
        $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
        if ($_POST['NasabahPeroranganDn']['idPropinsiDomisili'] !== '')
            echo CHtml::tag('option', array('value' => 440), CHtml::encode('Lain-lain'), true);
    }

    public function actionDynamicNegaraNasabahPeroranganDnIdentitas() {
        if ($_POST['NasabahPeroranganDn']['idPropinsiIdentitas'] === '')
            $data = Kabupaten::model()->findAll();
        else
            $data = Kabupaten::model()->findAll('propinsi_id=:propinsiId', array(':propinsiId' => (int) $_POST['NasabahPeroranganDn']['idPropinsiIdentitas']));

        $data = CHtml::listData($data, 'id', 'nama');
        $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
        if ($_POST['NasabahPeroranganDn']['idPropinsiIdentitas'] !== '')
            echo CHtml::tag('option', array('value' => 440), CHtml::encode('Lain-lain'), true);
    }

    public function actionDynamicNegaraNasabahKorporasiDnPropinsi() {
        if ($_POST['NasabahKorporasiDn']['idPropinsi'] === '')
            $data = Kabupaten::model()->findAll();
        else
            $data = Kabupaten::model()->findAll('propinsi_id=:propinsiId', array(':propinsiId' => (int) $_POST['NasabahKorporasiDn']['idPropinsi']));

        $data = CHtml::listData($data, 'id', 'nama');
        $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
        if ($_POST['NasabahKorporasiDn']['idPropinsi'] !== '')
            echo CHtml::tag('option', array('value' => 440), CHtml::encode('Lain-lain'), true);
    }

    public function actionDynamicNegaraNonNasabahDnPropinsi() {
        if ($_POST['NonNasabahDn']['idPropinsi'] === '')
            $data = Kabupaten::model()->findAll();
        else
            $data = Kabupaten::model()->findAll('propinsi_id=:propinsiId', array(':propinsiId' => (int) $_POST['NonNasabahDn']['idPropinsi']));

        $data = CHtml::listData($data, 'id', 'nama');
        $data = CMap::mergeArray(array('' => 'Pilih'), $data);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
        if ($_POST['NonNasabahDn']['idPropinsi'] !== '')
            echo CHtml::tag('option', array('value' => 440), CHtml::encode('Lain-lain'), true);
    }

    /**
     * List all ajax action to generate 
     */
    public function actionExportToExcel($id) {
        $this->checkAccess('swiftIncoming.exportToExcel');

        $model = Swift::model()->findByPk($id);
        Yii::app()->request->sendFile('swift_' . date('dmY') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionCreateExcel($id) {
        $this->checkAccess('swiftIncoming.createExcel');

        // Find Single Data Swift
        $oneData = Swift::model()->findByPk($id);
        $jenisSwift = $oneData->jenisSwift;
        $pengirim = Yii::app()->util->getPengirim($id, 'all');
        $penerima = Yii::app()->util->getPenerima($id, 'all');

        //Create Excel
        Yii::import('ext.phpexcel.XPHPExcel');
        $objPHPExcel = XPHPExcel::createPHPExcel();
        $objPHPExcel->getProperties()->setCreator("Ahda Ridwan")
                ->setLastModifiedBy("Ahda Ridwan")
                ->setTitle("Office 2007 XLSX Production Document")
                ->setSubject("Office 2007 XLSX Production Document")
                ->setDescription("Production document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Production result file");

        // Set AutoSize
        PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

        // Set AutoSize to Column
        foreach (range('A', 'E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }

        // White Page Default
        $objPHPExcel->getDefaultStyle()->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('argb' => 'FFFFFFFF')
                    ),
                )
        );

        // Set Bold & Center Font
        $styleArray = array(
            'font' => array(
                'bold' => true
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );

        // Set Border
        $styleArrayBord = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        // Set Bold
        $styleArrayOther = array(
            'font' => array(
                'bold' => true
            )
        );

        // Add Text Header
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'LAPORAN TRANSAKSI KEUANGAN TRANSFER DANA DARI DAN KE LUAR NEGERI');

        // Merge Column
        $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

        // Center Header
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);

        // Data Umum
        $dataUmum = array(
            array('1' => 'I. Umum', '2' => ''),
            array('1' => 'No LTKL', '2' => ': ' . $oneData->noLtdln),
            array('1' => 'No LTDLN Koreksi', '2' => ': ' . $oneData->noLtdlnKoreksi),
            array('1' => 'Tanggal Laporan', '2' => ': ' . Yii::app()->dateFormatter->format('d-MM-yyyy', $oneData->tglLaporan)),
            array('1' => 'Nama PJK Bank Pelapor', '2' => ': ' . $oneData->namaPjk),
            array('1' => 'Nama Pejabat PJK Bank Pelapor', '2' => ': ' . $oneData->namaPejabatPjk),
            array('1' => 'Jenis Laporan', '2' => ': ' . $oneData->getJenisLaporanText()),
        );

        $dataPengirimPerorangan = '';
        $alamatSesuaiIndentitasPerorangan = '';
        $negaraPerorangan = '';
        $negaraPeroranganVoucher = '';
        $wargaNegaraPerorangan = '';

        switch ($pengirim['key']) {
            case 1:
                $pengirimPerorangan = $pengirim['data'];
                $negaraPerorangan = $pengirimPerorangan->idNegaraKewarganegaraan0->nama;
                $negaraPeroranganVoucher = $pengirimPerorangan->idNegaraVoucher0->nama;
                $wargaNegaraPerorangan = Yii::app()->util->getKodeStandar(array('modul' => 'kewarganegaraan', 'data' => $pengirimPerorangan->wargaNegara));

                // Data Identitas Pengirim Nasabah Perorangan
                $dataPengirimPerorangan = array(
                    array('1' => 'II. Identitas Pengirim Nasabah Perorangan', '2' => ''),
                    array('1' => 'No Rekening', '2' => ': ' . $pengirimPerorangan->noRekening),
                    array('1' => 'Nama Lengkap', '2' => ': ' . $pengirimPerorangan->namaLengkap),
                    array('1' => 'Tanggal Lahir', '2' => ': ' . $pengirimPerorangan->tglLahir),
                    array('1' => 'Kewarganegaraan', '2' => ': ' . $wargaNegaraPerorangan),
                    array('1' => 'Negara', '2' => ': ' . $negaraPerorangan),
                    array('1' => 'Negara Lain', '2' => ': ' . $pengirimPerorangan->negaraLainKewarganegaraan),
                    array('1' => '', '2' => ': '),
                );

                $alamatSesuaiIndentitasPerorangan = array(
                    array('1' => 'Alamat Sesuai Bukti Identitas/Voucher', '2' => ''),
                    array('1' => 'Alamat', '2' => ': ' . $pengirimPerorangan->alamat),
                    array('1' => 'Negara Bagian/Kota', '2' => ': ' . $pengirimPerorangan->negaraBagianKota),
                    array('1' => 'Negara', '2' => ': ' . $negaraPeroranganVoucher),
                    array('1' => 'Negara Lainnya', '2' => ': ' . $pengirimPerorangan->negaraLainVoucher),
                    array('1' => 'No Telp', '2' => ': ' . $pengirimPerorangan->noTelp),
                    array('1' => 'KTP', '2' => ': ' . $pengirimPerorangan->ktp),
                );

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $pengirimKorporasi = new NasabahKorporasiLn;
                    $pengirimNonNasabah = new NonNasabahLn;
                } else {
                    $pengirimKorporasi = new NasabahKorporasiDn;
                    $pengirimNonNasabah = new NonNasabahDn;
                }
                break;
            case 2:
                $pengirimKorporasi = $pengirim['data'];

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $pengirimPerorangan = new NasabahPeroranganLn;
                    $pengirimNonNasabah = new NonNasabahLn;
                } else {
                    $pengirimPerorangan = new NasabahPeroranganDn;
                    $pengirimNonNasabah = new NonNasabahDn;
                }
                break;
            case 3:
                $pengirimNonNasabah = $pengirim['data'];

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $pengirimPerorangan = new NasabahPeroranganLn;
                    $pengirimKorporasi = new NasabahKorporasiLn;
                } else {
                    $pengirimPerorangan = new NasabahPeroranganDn;
                    $pengirimKorporasi = new NasabahKorporasiDn;
                }
                break;

            default:
                break;
        }

        switch ($penerima['key']) {
            case 1:
                $penerimaPerorangan = $penerima['data'];

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $penerimaKorporasi = new NasabahKorporasiLn;
                    $penerimaNonNasabah = new NonNasabahLn;
                } else {
                    $penerimaKorporasi = new NasabahKorporasiDn;
                    $penerimaNonNasabah = new NonNasabahDn;
                }
                break;
            case 2:
                $penerimaKorporasi = $penerima['data'];

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $penerimaPerorangan = new NasabahPeroranganLn;
                    $penerimaNonNasabah = new NonNasabahLn;
                } else {
                    $penerimaPerorangan = new NasabahPeroranganDn;
                    $penerimaNonNasabah = new NonNasabahDn;
                }
                break;
            case 3:
                $penerimaNonNasabah = $penerima['data'];

                if ($jenisSwift == 1 || $jenisSwift == 3) {
                    $penerimaPerorangan = new NasabahPeroranganLn;
                    $penerimaKorporasi = new NasabahKorporasiLn;
                } else {
                    $penerimaPerorangan = new NasabahPeroranganDn;
                    $penerimaKorporasi = new NasabahKorporasiDn;
                }
                break;

            default:
                break;
        }

        // Array to Set Bold
        $setBold = array(
            '1' => 'A3',
            '2' => 'A11:E11',
            '3' => 'A19',
            '4' => 'A22',
        );

        // Looping Bold
        foreach ($setBold as $value) {
            $objPHPExcel->getActiveSheet()->getStyle($value)->applyFromArray($styleArrayOther);
        }

        // Looping Data Umum
        $sheetActive = $objPHPExcel->getActiveSheet();
        foreach ($dataUmum as $row => $columns) {
            foreach ($columns as $column => $data) {
                $sheetActive->setCellValueByColumnAndRow($column - 1, $row + 3, $data);
            }
        }

        // Looping Data Pengirim Nasabah Perorangan
        if ($dataPengirimPerorangan) {
            $sheetActive = $objPHPExcel->getActiveSheet();
            foreach ($dataPengirimPerorangan as $row => $columns) {
                foreach ($columns as $column => $data) {
                    $sheetActive->setCellValueByColumnAndRow($column - 1, $row + 11, $data);
                }
            }
        }

        // Looping Data Pengirim Nasabah Perorangan :: Sesuai Identitas
        if ($alamatSesuaiIndentitasPerorangan) {
            $sheetActive = $objPHPExcel->getActiveSheet();
            foreach ($alamatSesuaiIndentitasPerorangan as $row => $columns) {
                foreach ($columns as $column => $data) {
                    $sheetActive->setCellValueByColumnAndRow($column + 1, $row + 11, $data);
                }
            }
        }

        $jenisSwiftText = Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $jenisSwift));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));

        // Redirect output to a client web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $jenisSwiftText . ' - ' . $oneData->localId . ', ' . date('d-m-Y') . '.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();
    }

}