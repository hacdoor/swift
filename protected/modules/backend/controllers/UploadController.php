<?php

class UploadController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $typeUpload = $_GET['type'];
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'Transaksi'),
            1 => array('url' => '', 'label' => 'Upload Data ' . $typeUpload)
        );

        if ((!empty($_FILES["fileUpload"]))) {
            if (($_FILES['fileUpload']['error'] == 0)) {
                $fileName = CUploadedFile::getInstanceByName('fileUpload');
                $ext = $fileName->getExtensionName();
                $name = $fileName->getName();
                $type = $fileName->getType();
                if ($typeUpload === 'trx') {
                    if (($ext === "txt") && ($type === "text/plain")) {
                        $date = date('H:i:s d-m-Y');
                        $admin = Yii::app()->user->getState('admin');
                        $user_id = $admin->id;
                        $filename = sha1($name . $date . $user_id);
                        $newname = 'log/' . $filename . '.' . $ext;

                        if (!file_exists($newname)) {
                            if ($fileName->saveAs($newname)) {
//                            $tmpFile = file_get_contents($newname);
//                            $tmpFile = mb_convert_encoding($tmpFile, 'UTF-8');
//                            file_put_contents($newname, 'test' . $tmpFile);
                                $fp = fopen($newname, "r") or die("Couldn't open $newname");
                                $data = array();
                                while (!feof($fp)) {
                                    $buffer = stream_get_line($fp, 1024, PHP_EOL);
                                    $data[] = Yii::app()->util->cleanString($buffer);
                                }

//                            file_put_contents($newname, 'test' . $tmpFile);
                                $swData = Yii::app()->util->getSwiftData($data);
                                echo '<pre>';
                                print_r($swData);
                                echo '</pre>';
                                fclose($fp);
                                unlink($newname);

                                Yii::app()->user->setFlash('success', 'Success!|' . 'Data has been uploaded.');
                            } else {
                                Yii::app()->user->setFlash('danger', 'Error!|' . "Error: A problem occurred during file upload! " . $newname);
                            }
                        } else {
                            Yii::app()->user->setFlash('danger', 'Error!|' . $name . " already exists");
                        }
                    } else {
                        Yii::app()->user->setFlash('danger', 'Error!|' . 'Error: Only .txt  are accepted for upload');
                    }
                } else if ($typeUpload === 'person') {
                    if ($ext === "csv") {
                        $fp = fopen($fileName->getTempName(), "r") or die("Couldn't open $newname");
                        $data = array();
                        while (!feof($fp)) {
                            $buffer = stream_get_line($fp, 1024, PHP_EOL);
                            $data[] = Yii::app()->util->cleanString($buffer);
                        }
                        $personData = Yii::app()->util->getPersonData($data);
                        echo '<pre>';
                        print_r($personData);
                        echo '</pre>';
                        fclose($fp);
                    } else {
                        Yii::app()->user->setFlash('danger', 'Error!|' . 'Error: Only .csv  are accepted for upload');
                    }
                } else if ($typeUpload === 'kyc') {
                    if (($ext === "xls" || $ext === 'xlsx')) {
                        spl_autoload_unregister(array('YiiBase', 'autoload'));
                        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.vendor.PHPExcel');
                        include($phpExcelPath . DIRECTORY_SEPARATOR . 'IOFactory.php');
                        spl_autoload_register(array('YiiBase', 'autoload'));

                        $objPHPExcel = PHPExcel_IOFactory::load($fileName->getTempName());

                        $sheet = $objPHPExcel->getActiveSheet();
                        $highestRow = $sheet->getHighestRow();
//                    $highestColumn = $sheet->getHighestColumn();
//                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                        $dataKorporasi = array();
                        $dataKorporasi['info'] = 0;
                        $flag = 0;
                        for ($row = 12, $i = 0; $row <= $highestRow; ++$row, $i++) {
                            if ($flag == 3)
                                break;
                            if ($sheet->getCellByColumnAndRow(0, $row)->getValue()) {
                                $dataKorporasi['data'][$i]['nama'] = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                                $dataKorporasi['data'][$i]['noRekening'] = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                                $dataKorporasi['data'][$i]['tujuanTransaksi'] = $sheet->getCellByColumnAndRow(8, $row)->getValue();
                                $dataKorporasi['data'][$i]['sumberDana'] = $sheet->getCellByColumnAndRow(9, $row)->getValue();
                                $dataKorporasi['data'][$i]['npwp'] = $sheet->getCellByColumnAndRow(20, $row)->getValue();
                            } else {
                                $flag++;
                            }
                        }
                        if (key_exists('data', $dataKorporasi)) {
                            $dataKorporasi['info'] = count($dataKorporasi['data']);
                        }
                        echo '<pre>';
                        print_r($dataKorporasi);
                        echo '</pre>';
                        Yii::app()->user->setFlash('success', 'Success!|' . 'Data has been uploaded.');
                    } else {
                        Yii::app()->user->setFlash('danger', 'Error!|' . 'Error: Only .xls  are accepted for upload');
                    }
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Error: No file uploaded');
            }
        }
        $source = Company::model()->findByPk(1);
        switch ($typeUpload) {
            case 'trx':
                $src = $source->trxSource;

                break;

            default:
                break;
        }
        $vars = array(
            'type' => $typeUpload,
            'src' => $src,
            'breadcrumb' => $breadcrumb
        );
        $this->render('index', $vars);
        Yii::app()->end();
    }

}