<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "types".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $income_type_name
 * @property mixed $expense_type_name
 * @property mixed $expense_id
 * @property mixed $income_id
 * @property mixed $user_id
 */
class Types extends \yii\mongodb\ActiveRecord
{

    public static function collectionName()
    {
        return 'types';
    }

    public function attributes()
    {
        return [
            '_id',
            'income_type_name',
            'expense_type_name',
            'expense_id',
            'income_id',
            'user_id',
        ];
    }

    public function rules()
    {
        return [
            [['income_type_name', 'expense_type_name', 'expense_id', 'income_id', 'user_id'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'income_type_name' => 'Income Type Name',
            'expense_type_name' => 'Expense Type Name',
            'expense_id' => 'Expense ID',
            'income_id' => 'Income ID',
            'user_id' => 'User ID',
        ];
    }

    public function getTableSchema()
    {
        return false;
    }
}
