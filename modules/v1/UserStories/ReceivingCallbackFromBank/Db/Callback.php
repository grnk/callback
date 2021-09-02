<?php

namespace modules\v1\UserStories\ReceivingCallbackFromBank\Db;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property int $id
 * @property string $account
 * @property int $amount
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 */
class Callback extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%callback}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}