<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'defaultController' => 'index',
    'language' => 'zh_cn',
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '192.168.1.50', '192.168.1.254', '192.168.1.80', '::1'),
        ),
        'admin', 'mp'
    ),
    // application components
    'components' => array(
        'thumb' => array(
            'class' => 'ext.CThumb.CThumb',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'stateKeyPrefix' => 'mp',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            //array(
            //'class'=>'CWebLogRoute',
            //),
            ),
        ),
        /* 'log'=>array(
          'class'=>'CLogRouter',
          'routes'=>array(
          array(
          'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
          'ipFilters'=>array('127.0.0.1','192.168.1.50','192.168.1.254'),
          ),
          ),
          ), */
         'cache' => array(
          'class' => 'system.caching.CMemCache',
          'servers' => array(
          	array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 60),
          ),
          ),
        /*'cache' => array(
            'class' => 'system.caching.CFileCache',
            'directoryLevel' => 2,
        ),*/
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'user_verify' => array(
            'num_limit' => 10, // 一天最多发送几次短信
            'send_time_gap' => '60', //两次发送验证码的间隔
            'expire_time' => 86400,
        ),
        'email' => array(
            'email_server' => 'smtp.126.com',
            'email_port' => 25,
            'email_user' => 'ycgpp@126.com',
            'email_password' => 'ycGPP163',
            'email_from' => 'ycgpp@126.com',
            'site_name' => '搜景观',
        ),
        'thumb' => array(
            'main_item' => array('260x260', '680x680', '140x140'),
        ),
        'cache' => array(
            'is_use_cache' => 1,
        ),
    ),
);
