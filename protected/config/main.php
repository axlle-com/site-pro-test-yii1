<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii Application Test',

    // preloading 'log' component
    'preload' => ['log'],

    // autoloading model and component classes
    'import' => [
        'application.models.Form.*',
        'application.models.DB.*',
        'application.components.*',
    ],

    'modules' => [
        // uncomment the following to enable the Gii tool
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => ['127.0.0.1', '::1'],
        ],
    ],

    // application components
    'components' => [

        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ],

        'request' => [
//            'enableCookieValidation' => true,
//            'enableCsrfValidation' => true,
        ],

        // uncomment the following to enable URLs in path-format
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => [
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',

                '/' => 'site/index',
                'ajax/<action:\w+>' => 'ajax/<action>',
                '<action:\w+>' => 'site/<action>',
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        // database settings are configured in database.php
        'db' => require(__DIR__ . '/database.php'),

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ],
        ],

        'clientScript' => [
            'scriptMap' => [
                'jquery.js' => false,
            ],
            'enableJavaScript' => false,
        ],

    ],

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => [
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ],
];
