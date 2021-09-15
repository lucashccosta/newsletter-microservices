<?php

namespace App\Container;

use App\Contracts\Broker;
use App\Queue\Kafka;
use App\Repositories\MailRepository;
use App\Services\MailService;
use Libs\Core\Application;

abstract class Injection
{
    public static function resolve()
    {
        Application::$app->bind(MailRepository::class, MailRepository::class);
        Application::$app->bind(MailService::class, MailService::class);
        Application::$app->bind(Broker::class, Kafka::class);
    }
}
