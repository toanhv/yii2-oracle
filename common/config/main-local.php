<?php

return [
    'components' => [
//        'db' => [
//            'class' => 'apaoww\oci8\Oci8DbConnection',
//            'dsn' => 'oci8:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=10.60.105.79)(PORT=1521))(CONNECT_DATA=(SID=orcl79)));charset=UTF8;', // Oracle
//            'username' => 'airtimegw',
//            'password' => 'VuLuc$2017',
//            'attributes' => [
//                PDO::ATTR_STRINGIFY_FETCHES => true,
//            ]
//        ],
        'db' => [
            'class' => 'apaoww\oci8\Oci8DbConnection',
            'dsn' => 'oci8:dbname=(DESCRIPTION=(LOAD_BALANCE=yes)(ADDRESS=(PROTOCOL=TCP)(HOST= 10.60.137.5)(PORT=1521))(ADDRESS=(PROTOCOL=TCP)(HOST= 10.60.137.7)(PORT=1521))(CONNECT_DATA= (FAILOVER_MODE=(TYPE=select)(METHOD=basic)(RETRIES=180)(DELAY=5))(SERVICE_NAME=api)));charset=UTF8;',
            'username' => 'VIDOANHNGHIEP',
            'password' => 'vidoanhnghiep',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
            'attributes' => [
                PDO::ATTR_STRINGIFY_FETCHES => true,
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
