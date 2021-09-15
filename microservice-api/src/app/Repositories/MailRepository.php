<?php

namespace App\Repositories;

use App\Entities\Mail;
use Libs\Core\Database\Orm\Doctrine\Repository as DoctrineRepository;

final class MailRepository extends DoctrineRepository
{
    /**
     * @override
     * @return string
     */
    public function entity(): string 
    {
        return Mail::class;
    }
}
