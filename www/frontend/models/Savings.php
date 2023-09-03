<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "savings".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $amount
 * @property mixed $start_date
 * @property mixed $end_date
 * @property mixed $user_id
 */
class Savings extends \yii\mongodb\ActiveRecord
{

    public static function collectionName()
    {
        return 'savings';
    }

    public function attributes()
    {
        return [
            '_id',
            'amount',
            'start_date',
            'end_date',
            'user_id',
        ];
    }

    public function rules()
    {
        // return [
        //     [['amount', 'start_date', 'end_date', 'user_id'], 'safe'],
        //     // ensure empty values are stored as NULL in the database
        //     ['start_date', 'default', 'value' => null],

        //     // validate the date and overwrite `deadline` with the unix timestamp
        //     ['start_date', 'date', 'timestampAttribute' => 'start_date'],
        // ];

        return [
            [['amount', 'start_date', 'end_date', 'user_id'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'amount' => 'Amount',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'user_id' => 'User ID',
        ];
    }
    public function getTableSchema()
    {
        return false;
    }
}
