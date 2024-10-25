<?php

/**
 * MultiFlexi - Phinx database adapter.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2021-2024 Vitex Software
 */
if (file_exists('./vendor/autoload.php')) {
    include_once './vendor/autoload.php';
} else {
    include_once '../vendor/autoload.php';
}


$prefix = file_exists('./db/') ? './db/' : '../db/';

$sqlOptions = [];

require('catalog/includes/local/configure.php');


     return [
        "paths" => [
            "migrations" => "db/migrations"
        ],
        "environments" => [
            "default_migration_table" => "phinxlog",
            "default_environment" => "dev",
            "dev" => [
                "adapter" => "mysql",
                "host" => DB_SERVER,
                "name" => DB_DATABASE,
                "user" => DB_SERVER_USERNAME,
                "pass" => DB_SERVER_PASSWORD,
                "port" => '3306'
            ]
        ]
    ];
