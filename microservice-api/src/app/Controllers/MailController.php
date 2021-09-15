<?php

namespace App\Controllers;

use App\Entities\Mail;
use App\Services\MailService;
use Libs\Core\Controller;
use Libs\Core\Exceptions\BadRequestException;
use Libs\Core\Request;
use Libs\Core\Response;

final class MailController extends Controller
{
    /**
     * @var \App\Services\MailService
     */
    private MailService $service;

    public function __construct(MailService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, Response $response)
    {   
        $mails = $this->service->list();
        return $response->json($mails);
    }

    public function store(Request $request, Response $response)
    {
        $data = $request->body();
        $mail = $this->service->store($data);
        return $response->json($mail);
    }
}
