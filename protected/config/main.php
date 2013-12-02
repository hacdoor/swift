<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'YooHee! CMS Frontend',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'banjarwijaya',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'backend',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'backend/setting/<action:\w+>/<id:[0-9]+>' => 'backend/setting/<action>',
                'backend/comment/<action:\w+>/<id:[0-9]+>' => 'backend/comment/<action>',
                'backend/mediacomment/<action:\w+>/<id:[0-9]+>' => 'backend/mediacomment/<action>',
                'backend/content/<type:[a-zA-Z0-9_\-]+>' => 'backend/content/index',
                'backend/mata-uang' => 'backend/uang/index',
                'backend/mata-uang/<action:\w+>' => 'backend/uang/<action>',
                'backend/mata-uang/<action:\w+>/<id:\d+>' => 'backend/uang/<action>',
                'backend/meta/<content:[a-zA-Z0-9_\-]+>' => 'backend/meta/index',
                'backend/mediameta/<media:[a-zA-Z0-9_\-]+>' => 'backend/mediameta/index',
                'backend/classification/<taxonomy:[a-zA-Z0-9_\-]+>' => 'backend/classification/index',
                'backend/contentfield/create/<type:[a-zA-Z0-9_\-]+>' => 'backend/contentfield/create',
                'backend/contentfield/<type:[a-zA-Z0-9_\-]+>' => 'backend/contentfield/index',
                'backend/media/update/<slug:[a-zA-Z0-9_\-]+>' => 'backend/media/update',
                'backend/media/delete/<slug:[a-zA-Z0-9_\-]+>' => 'backend/media/delete',
                'backend/media/image/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/image',
                'backend/media/flash/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/file',
                'backend/media/pdf/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/file',
                'backend/media/file/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/file',
                'backend/media/embed/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/file',
                'backend/media/<action:\w+>/<mgroup:[a-zA-Z0-9_\-]+>/<content:[a-zA-Z0-9_\-]+>' => 'backend/media/<action>',
                'backend/<controller:\w+>/<action:\w+>/<id:[0-9]+>' => 'backend/<controller>/<action>',
                'backend/<controller:\w+>/<action:\w+>' => 'backend/<controller>/<action>',
                'backend/<controller:\w+>/<action:\w+>/<slug:[a-zA-Z0-9_\-]+>' => 'backend/<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          // uncomment the following to use a MySQL database
         */
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=swift_ifti',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'darina',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'backend/default/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'setting' => array(
            'class' => 'application.components.SettingComponent',
        ),
        'util' => array(
            'class' => 'application.components.UtilComponent',
        ),
        'imageapi' => array(
            'class' => 'ext.imageapi.CImage',
            'presets' => array(
                'bodyThumb' => array(
                    'cacheIn' => 'webroot.assets.imagecache.bodyThumb',
                    'actions' => array(
                        'scale' => array('width' => 200, 'height' => 150),
                    ),
                ),
                'bodyView' => array(
                    'cacheIn' => 'webroot.assets.imagecache.bodyView',
                    'actions' => array(
                        'scale' => array('width' => 400, 'height' => 300),
                    ),
                ),
                'contentPictureUpload' => array(
                    'cacheIn' => 'webroot.assets.imagecache.contentPictureUpload',
                    'actions' => array(
                        'scale' => array('width' => 320, 'height' => 215),
                    ),
                ),
                'contentPictureThumb' => array(
                    'cacheIn' => 'webroot.assets.imagecache.contentPictureThumb',
                    'actions' => array(
                        'scale' => array('width' => 150, 'height' => 100),
                    ),
                ),
                'contentPictureView' => array(
                    'cacheIn' => 'webroot.assets.imagecache.contentPictureView',
                    'actions' => array(
                        'scale' => array('width' => 800, 'height' => 600),
                    ),
                ),
                'mediaList' => array(
                    'cacheIn' => 'webroot.assets.imagecache.mediaList',
                    'actions' => array(
                        'scale' => array('width' => 180, 'height' => 135),
                    ),
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => include(dirname(__FILE__) . '/params.php'),
);
