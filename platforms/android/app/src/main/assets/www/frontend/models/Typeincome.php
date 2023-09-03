<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "typeincome".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $type_name
 * @property mixed $status
 */
class Typeincome extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'typeincome';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'type_name',
            'user_id',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'user_id'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'type_name' => 'Type Name',
            'user_id' => 'User id',
        ];
    }

    public function getTableSchema()
    {
        return false;
    }
}
