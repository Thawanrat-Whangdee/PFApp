<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "incomes".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $income_type
 * @property mixed $amount
 * @property mixed $create_date
 * @property mixed $update_date
 * @property mixed $create_by
 * @property mixed $update_by
 */
class Incomes extends \yii\mongodb\ActiveRecord
{
    public static function collectionName()
    {
        return 'incomes';
    }

    public function attributes()
    {
        return [
            '_id',
            'income_type',
            'amount',
            'create_date',
            'update_date',
            'create_by',
            'update_by',
        ];
    }

    public function rules()
    {
        return [
            [['income_type', 'amount', 'create_date', 'update_date', 'create_by', 'update_by'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'income_type' => 'Income Type',
            'amount' => 'Amount',
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
