<?php

return [
    'brokers' => [
        'kafka' => [
            'global' => [
                'group.id' => uniqid('', true),
                'metadata.broker.list' => $_ENV['KAFKA_HOST'] ?? 'localhost:9092',
                'enable.auto.commit' => 'false',
            ],
            'topic' => [
                'auto.offset.reset' => 'beginning',
            ],
        ]
    ]
];
