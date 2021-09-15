<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Libs\Core\Database\Orm\Doctrine\BaseEntity;

/**
 * @ORM\Entity 
 * @ORM\Table(name="mails")
 */
class Mail extends BaseEntity implements JsonSerializable
{
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length="255")
     */
    protected $email;

    /**
     * @ORM\Column(type="string",length="10")
     */
    protected $status;

    public function getId()
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'status' => $this->getStatus(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}