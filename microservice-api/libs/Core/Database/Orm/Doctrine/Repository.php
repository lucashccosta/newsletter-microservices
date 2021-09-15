<?php

namespace Libs\Core\Database\Orm\Doctrine;

use Libs\Core\Application;
use Libs\Core\Contracts\IRepository;

abstract class Repository implements IRepository
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = Application::$app->database->instance()->connection;
    }

     /**
     * Get entity class name
     * @return string
     */
    abstract public function entity(): string;

    public function all()
    {
        return $this->entityManager
            ->getRepository($this->entity())
            ->findAll();
    }

    public function create($data)
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        return $data;
    }
}
