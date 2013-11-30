<?php

class BackendModule extends CWebModule {

    private $_assetsUrl;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'backend.models.*',
            'backend.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            // Layouts
            $this->layoutPath = Yii::getPathOfAlias('backend.views.layouts');
            $this->layout = 'main';

            // Publish assets
            if ($this->_assetsUrl === null)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                        Yii::getPathOfAlias('backend.asset'), false, // hash by name
                        -1, // recursive level
                        true  // force copy (disable cache)
                );

            return true;
        }
        else
            return false;
    }

    public function getAssetsUrl() {
        return $this->_assetsUrl;
    }

}