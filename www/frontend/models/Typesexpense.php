<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "typesexpense".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $type_name
 * @property mixed $status
 */
class Typesexpense extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'typesexpense';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'type_name',
            'status',
            'ratio',
            'user_id',
            'create_date',
            'expense_kind'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'status', 'ratio','user_id','create_date','expense_kind'], 'safe']
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
            'status' => 'Status',
            'ratio'  => 'Ratio',
            'user_id' => 'User Id',
            'create_date' => 'Create Date',
            'expense_kind' => 'Expense Kind'
        ];
    }
    public function getTableSchema()
    {
        return false;
    }
}
