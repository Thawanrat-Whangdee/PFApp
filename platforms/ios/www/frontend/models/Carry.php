<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "carry".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $status
 * @property mixed $date
 */
class Carry extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'carry';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'status',
            'date',
            'user_id'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'date','user_id'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'status' => 'Status',
            'date' => 'Date',
            'user_id' => 'User Id'        ];
    }
    public function getTableSchema()
    {
        return false;
    }
}
