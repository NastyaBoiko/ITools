<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=itools',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

// return [
//     'class' => 'yii\db\Connection',
//     'dsn' => 'mysql:host=localhost;dbname=asfhpsun_m2',
//     'username' => 'asfhpsun',
//     'password' => 'GXsEYk',
//     'charset' => 'utf8',

//     // Schema cache options (for production environment)
//     //'enableSchemaCache' => true,
//     //'schemaCacheDuration' => 60,
//     //'schemaCache' => 'cache',
// ];

// 'attributes' => [
//         PDO::ATTR_PERSISTENT => true,
//         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION"'
//     ],