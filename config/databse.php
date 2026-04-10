<?php
return [
    'driver'   => 'mysql',
    'host'     => 'db',
    'database' => 'gestao_escolar',
    'username' => 'fran',
    'password' => 'root',
    'charset'  => 'utf8mb4',
    'options'  => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
