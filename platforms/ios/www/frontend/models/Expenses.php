<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "expenses".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $expense_type
 * @property mixed $amount
 * @property mixed $create_date
 * @property mixed $update_date
 * @property mixed $create_by
 * @property mixed $update_by
 */
class Expenses extends \yii\mongodb\ActiveRecord
{
    public static function collectionName()
    {
        return 'expenses';
    }

    public function attributes()
    {
        return [
            '_id',
            'expense_type',
            'amount',
            'create_date',
            'update_date',
            'create_by',
            'update_by',
            'expense_kind'
        ];
    }

    public function rules()
    {
        return [
            [['expense_type', 'amount', 'create_date', 'update_date', 'create_by', 'update_by','expense_kind'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'expense_type' => 'Expense Type',
            'amount' => 'Amount',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'expense_kind' => 'Expense Kind'
        ];
    }
    public function getTableSchema()
    {
        return false;
    }
}
