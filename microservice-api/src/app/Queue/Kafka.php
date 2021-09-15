<?php

namespace App\Queue;

use App\Contracts\Broker;
use App\Exceptions\BrokerException;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Exception;

class Kafka implements Broker
{   
    /**
     * @var \Enqueue\RdKafka\RdKafkaContext
     */
    private $context;

    public function __construct()
    {
        $config = require_once(__DIR__.'/../../config/queue.php');
        $this->context = (new RdKafkaConnectionFactory($config['brokers']['kafka']))
            ->createContext();
    }

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
    ): void {
        try {
            $topic = $this->context->createTopic($queue);
            $message = $this->context->createMessage(json_encode($payload));
            $this->context
                ->createProducer()
                ->send($topic, $message);
        } catch (Exception $e) {
            throw new BrokerException("Can't publish message > {$e->getMessage()}");
        }
    }
}
