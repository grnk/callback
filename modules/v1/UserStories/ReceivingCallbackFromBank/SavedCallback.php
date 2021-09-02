<?php

namespace modules\v1\UserStories\ReceivingCallbackFromBank;

use modules\v1\UserStories\ReceivingCallbackFromBank\Db\Callback;
use DateTime;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

class SavedCallback
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function result(): bool
    {
        $isValidate = $this->model->validate();
        if (!$isValidate) {
            throw (new BadRequestHttpException(Json::encode($this->model->errors)));
        }

        $dbModel = (new Callback([
            'account' => $this->model->paymentData['account'],
            'amount' => $this->model->amount,
            'date' => (new DateTime($this->model->operationTimestamp))->format('Y-m-d H:i:s'),
        ]));
        if (!$dbModel->save()) {
            throw (new ServerErrorHttpException());
        }

        return true;
    }
}