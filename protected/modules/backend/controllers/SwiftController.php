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

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'sort' => $sort
        );

        $this->render('index', $vars);
    }

    public function actionGenerate() {
        $this->checkAccess('swift.generateXml');
        
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Proses'),
            1 => array('url' => '', 'label' => 'Generate XML')
        );
        
        $this->render('generateXml', array('breadcrumb' => $breadcrumb));
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

        $this->render('create', array(
            'model' => $model,
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


        $vars = array(
            'model' => $model,
            'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
            'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
            'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn,
            'number' => $number
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

        $vars = array(
            'model' => $model,
            'peroranganPengirimSwIn' => $peroranganPengirimSwIn,
            'korporasiPengirimSwIn' => $korporasiPengirimSwIn,
            'nonNasabahPengirimSwIn' => $nonNasabahPengirimSwIn,
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
        $model = Swift::model()->findAll();
        $dataFile = array();

        foreach ($model as $value) {
            $type = Yii::app()->util->getKodeStandar(array('modul' => 'swift', 'data' => $value->jenisSwift));
            $filename = 'download/' . $value->localId . '-' . $type . '.xml';

            $form = Yii::app()->util->getFormXml($value);
            $xml = Yii::app()->util->genSwiftXml($form, $xml = null, $root = 'ifti', $type);


            file_put_contents($filename, $xml);
            $dataFile[] = $filename;
        }

        Yii::app()->util->actionCreatefile('SWIFTXML.zip', $dataFile);
    }

}