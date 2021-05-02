<?php
return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'encryption' => 'tls',
        'host' => 'smtp.gmail.com',
        'port' => '587',
        'username' => '',
        'password' => '',
    ],
];