<?php

namespace App\Contracts;

interface Broker
{
    /**
     * @param string $queue
     * @param object $payload
     * @param array|null $params
     * @throws App\Exceptions\BrokerException
     * @return void
     */
    public function publish(
        string $queue, 
        object $payload, 
        ?array $params = []
    ): void;
}
