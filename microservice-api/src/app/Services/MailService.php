<?php

namespace App\Services;

use App\Contracts\Broker;
use App\Entities\Mail;
use App\Enums\Status;
use App\Repositories\MailRepository;
use DateTime;
use Exception;
use Libs\Core\Application;
use Libs\Core\Exceptions\BadRequestException;

final class MailService
{
    /**
     * @var \App\Repositories\MailRepository
     */
    private MailRepository $repository;

    /**
     * @var \App\Contracts\Broker
     */
    private Broker $broker;

    public function __construct()
    {
        $this->repository = Application::$app->container->get(MailRepository::class);
        $this->broker = Application::$app->container->get(Broker::class);
    }

    public function list()
    {
        return $this->repository->all();
    }

    public function store(array $data)
    {   
        if (!array_key_exists('mail', $data)) throw new BadRequestException();
        Application::$app->database->instance()->connection->beginTransaction();

        try {
            $mail = new Mail();
            $mail->setEmail($data['mail']);
            $mail->setStatus(Status::PROCESSING);
            $mail->setCreatedAt(new DateTime('now'));
            $mail->setUpdatedAt(new DateTime('now'));
            $mail = $this->repository->create($mail);
            
            $this->broker->publish(
                $_ENV['NEWSLETTER_QUEUE'] ?? 'newsletter_mails',
                $mail
            );

            Application::$app->database->instance()->connection->commit();
            
            return $mail;
        } catch (Exception $e) {
            Application::$app->database->instance()->connection->rollBack();
            throw $e;
        }
    }
}