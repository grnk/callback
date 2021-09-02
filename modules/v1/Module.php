<?php

namespace modules\v1;

use Yii;
use yii\web\Response;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\v1\Controllers';

    public function init()
    {
        parent::init();

        //Формат ответа JSON
        Yii::$app->request->parsers = ['application/json' => 'yii\web\JsonParser'];
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->formatters[Response::FORMAT_JSON] = [
            'class' => 'yii\web\JsonResponseFormatter',
        ];
    }
}