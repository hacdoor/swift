<?php

class UploaderController extends CController {

    public function actionUploadedImages() {
        $images = array();

        $handler = opendir(Yii::app()->basePath . '/../assets/body/img');

        while ($file = readdir($handler)) {
            if ($file != "." && $file != "..")
                $images[] = $file;
        }

        closedir($handler);

        $jsonArray = array();

        foreach ($images as $image)
            $jsonArray[] = array(
                'thumb' => Yii::app()->baseUrl . '/assets/imagecache/bodyThumb/' . $image,
                'image' => Yii::app()->baseUrl . '/assets/imagecache/bodyView/' . $image
            );

        header('Content-type: application/json');
        echo CJSON::encode($jsonArray);
    }

    public function actionUploadImage() {
        $image = new ImageForm;
        $image->file = CUploadedFile::getInstanceByName('file');
        if ($image->validate()) {
            if ($image->file->saveAs(Yii::app()->basePath . '/../assets/body/img/c-' . $image->file->name)) {
                $thumb = Yii::app()->util->generateImage('c-' . $image->file->name, 'body/img', 'bodyThumb');
                $img = Yii::app()->util->generateImage('c-' . $image->file->name, 'body/img', 'bodyView');
                echo CHtml::image($img);
                Yii::app()->end();
            }
        }

        throw new CHttpException(403, 'The server is crying in pain as you try to upload bad stuff');
    }

}