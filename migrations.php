<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = [__DIR__ . '/src'];
$isDevMode = true;

$dbParams = require __DIR__ . '/migrations-db.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: $paths,
    isDevMode: $isDevMode
);

$connection = DriverManager::getConnection($dbParams, $config);
new EntityManager($connection, $config);

return [
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
        'version_column_name' => 'version',
        'version_column_length' => 1024,
        'executed_at_column_name' => 'executed_at',
        'execution_time_column_name' => 'execution_time',
    ],

    'migrations_paths' => [
        'App\Migrations' => __DIR__ . '/migrations',
    ],

    'all_or_nothing' => true,
    'check_database_platform' => true,
];
