<?php

class UploadController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        if ((!empty($_FILES["fileUpload"]))) {
            if (($_FILES['fileUpload']['error'] == 0)) {
                $fileName = CUploadedFile::getInstanceByName('fileUpload');
                $ext = $fileName->getExtensionName();
                $name = $fileName->getName();
                $type = $fileName->getType();
                if (($ext === "txt") && ($type === "text/plain")) {
                    $date = date('H:i:s d-m-Y');
                    $admin = Yii::app()->user->getState('admin');
                    $user_id = $admin->id;
                    $filename = sha1($name . $date . $user_id);
                    $newname = 'log/' . $filename . '.' . $ext;

                    if (!file_exists($newname)) {
                        if ($fileName->saveAs($newname)) {
                            $tmpFile = file_get_contents($newname);
                            $tmpFile = mb_convert_encoding($tmpFile, 'UTF-8');
                            file_put_contents($newname, 'test'.$tmpFile);
                            $fp = fopen($newname, "r") or die("Couldn't open $newname");
                            $data = array();
                            $tmp = '';
                            while (!feof($fp)) {
                                $buffer = stream_get_line($fp, 1024, PHP_EOL);
                                $data[] = Yii::app()->util->cleanString($buffer);
                                $tmp .= $buffer;
                            }

                            file_put_contents($newname, 'test'.$tmpFile);
                            $swData = Yii::app()->util->getSwiftData($data);
                            echo '<pre>';
                            print_r($swData);
                            echo '</pre>';
                            fclose($fp);
                            //unlink($newname);

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
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Error: No file uploaded');
            }
        }

        $this->render('index');
    }

}