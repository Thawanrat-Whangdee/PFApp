<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "pocket".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $pocket_name
 * @property mixed $expense_type
 * @property mixed $ratio
 * @property mixed $create_date
 * @property mixed $user_id
 * @property mixed $expense_kind
 */
class Pocket extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'pocket';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'pocket_name',
            'expense_type',
            'ratio',
            'create_date',
            'user_id',
            'expense_kind',
            'status'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pocket_name', 'expense_type', 'ratio', 'create_date', 'user_id', 'expense_kind','status'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'pocket_name' => 'Pocket Name',
            'expense_type' => 'Expense Type',
            'ratio' => 'Amount',
            'create_date' => 'Create Date',
            'user_id' => 'User ID',
            'expense_kind' => 'Expense Kind',
            'status' => 'Status'
        ];
    }

    public function getTableSchema()
    {
        return false;
    }
}
