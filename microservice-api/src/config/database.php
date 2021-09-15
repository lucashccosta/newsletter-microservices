<?php

return [
    'database' => [
        'mysql' => [
            'host' => $_ENV['MYSQL_HOST'] ?? 'localhost',
            'port' => $_ENV['MYSQL_PORT'] ?? '3306',
            'dbname' => $_ENV['MYSQL_DBNAME'] ?? 'newsletter_signup',
            'user' => $_ENV['MYSQL_USER'] ?? '',
            'secret' => $_ENV['MYSQL_PASS'] ?? ''
        ]
    ],
    'orm' => [
        'doctrine' => [
            'entity' => [
                'path' => __BASE_PATH__.'/src/app/Entities'
            ],
            'environment' => [
                'is_dev' => ($_ENV['APP_ENVIRONMENT'] === 'dev')
            ]
        ]
    ]
];
