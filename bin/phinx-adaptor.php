<?php
require_once(__DIR__ . '/../catalog/admin/includes/configure.php');
//require_once('../catalog/admin/ext/devel/phinx/adaptor.php');

return
[
    'paths' => [
        'migrations' => DIR_FS_CATALOG .'../db/migrations',
        'seeds' => DIR_FS_CATALOG .'../db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'adapter' => 'mysql',
            'host' => constant('DB_SERVER'),
            'name' => constant('DB_DATABASE'),
            'user' => constant('DB_SERVER_ROOT_USERNAME'),
            'pass' => constant('DB_SERVER_ROOT_PASSWORD'),
            'port' => constant('DB_PORT'),
            'charset' => constant('DB_CHARSET'),
            'table_prefix' => ''
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => constant('DB_SERVER'),
            'name' => constant('DB_DATABASE'),
            'user' => constant('DB_SERVER_ROOT_USERNAME'),
            'pass' => constant('DB_SERVER_ROOT_PASSWORD'),
            'port' => constant('DB_PORT'),
            'charset' => constant('DB_CHARSET'),
            'table_prefix' => ''
        ]
    ],
    'version_order' => 'creation'
];
