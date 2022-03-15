<?php

// This is the database connection configuration.
return [
    'class' => 'CDbConnection',
    'connectionString' => 'mysql:host=localhost;dbname=information_schema',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];