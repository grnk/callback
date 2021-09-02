<?php

namespace modules\v1\UserStories\ReceivingCallbackFromBank\Validation;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class CallbackModel extends Model
{
    public $qrcId;
    public $trxId;
    public $amount;
    public $operationId;
    public $status;
    public $operationTimestamp;
    public $paymentData;

    public function rules()
    {
        return [
            [['qrcId', 'trxId', 'amount', 'operationId', 'status', 'operationTimestamp', 'paymentData'], 'required'],
            [['amount', 'operationId'], 'integer'],
            [['qrcId', 'trxId', 'status', 'operationTimestamp'], 'string'],
            [['paymentData'], 'checkPaymentData'],
        ];
    }

    public function checkPaymentData($attribute, $params)
    {
        if(!is_array($this->$attribute)) {
            $this->addError($attribute, "$attribute is not an array");
        }
        if(!ArrayHelper::keyExists('account', $this->$attribute)) {
            $this->addError($attribute, "In array $attribute no key 'account'");
        }
    }
}