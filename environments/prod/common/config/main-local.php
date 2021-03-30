<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=84.255.197.54;dbname=yii2advanced',
            'username' => 'newuser',
            'password' => 'password',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                "host" => "smtp.gmail.com",
                "username"=>"rezeljtim@gmail.com",
                "password"=>"mojeimejeburek2062",
                "port"=>"587",
                "encryption"=>"tls"
            ],
            'useFileTransport' => false,
        ],
    ],
];
