<?php

namespace Libs\Core\Database\Orm\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Libs\Core\Database\Database;

final class Builder extends Database
{   
    public function __construct(array $config)
    {
        $settings = Setup::createAnnotationMetadataConfiguration(
            [$config['orm']['doctrine']['entity']['path']],
            $config['orm']['doctrine']['environment']['is_dev'],
            null,
            null,
            false
        );

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => $config['database']['mysql']['host'],
            'port' => $config['database']['mysql']['port'],
            'dbname' => $config['database']['mysql']['dbname'],
            'user' => $config['database']['mysql']['user'],
            'password' => $config['database']['mysql']['secret'],
        ]);

        $this->connection = EntityManager::create($connection, $settings);
    }
}
