<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * @SWG\Swagger(
 *     basePath="/",
 *     @SWG\Info(version="1.0", title="Simple API"),
 * )
 */ 
class DocsController extends Controller
{
    public function actions()
    {
                return [
            'api' => [
                'class' => 'yii2mod\swagger\SwaggerUIRenderer',
                'restUrl' => Url::to(['docs/err']),
            ],
            'err' => [
                'class' => 'yii2mod\swagger\OpenAPIRenderer',
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                  Yii::getAlias("@app/modules/v1/controllers"),
                  Yii::getAlias("@common/models")
                ],
                'cache' => 'cache',
                'cacheKey' => 'api-swagger-cache', // default is 'api-swagger-cache'
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}