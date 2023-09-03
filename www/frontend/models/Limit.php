<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "limit".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $amount
 * @property mixed $user_id
 */
class Limit extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'limit';
    }

    public function attributes()
    {
        return [
            '_id',
            'amount',
            'user_id',
            'create_date',
            'update_date',
            'create_by',
            'update_by',
        ];
    }

    public function rules()
    {
        return [
            [['amount', 'user_id', 'create_date', 'update_date', 'create_by', 'update_by'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'amount' => 'Amount',
            'user_id' => 'User ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
        ];
    }

    public function getTableSchema()
    {
        return false;
    }
}
