<?php

return [
    'components' => [
        // 'db' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
        //     'username' => 'root',
        //     'password' => '1234',
        //     'charset' => 'utf8',
        // ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb+srv://root:1234@cluster0.ewl6c.mongodb.net/Project0?retryWrites=true&w=majority',
            'defaultDatabaseName'=>'yii2PFMS'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
