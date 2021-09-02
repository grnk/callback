<?php

namespace modules\v1\Controllers;

use modules\v1\UserStories\ReceivingCallbackFromBank\SavedCallback;
use modules\v1\UserStories\ReceivingCallbackFromBank\Validation\CallbackModel;
use Yii;
use yii\helpers\Json;
use yii\rest\Controller;

class CallbackController extends Controller
{
    public function actionIndex()
    {
        return (new SavedCallback(
            new CallbackModel(Json::decode(Yii::$app->request->rawBody))
        ))
            ->result();
    }
}