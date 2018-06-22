<?php 

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'pumpum-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => dirname(__DIR__).'/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'SVnVkT24CuHMpvpvZkiANzL6jR8xSNb0',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
    //    'response' => [
    //        'format' => yii\web\Response::FORMAT_JSON,
    //        'charset' => 'UTF-8'
    //    ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/user',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ]
                
                
            ],        
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',                
            'viewPath' => '@common/mail',
//            'transport' => [
//                    'class' => 'Swift_MailTransport',
//                ],
            'useFileTransport' => true,
        ],
    ],
    'params' => $params,
];