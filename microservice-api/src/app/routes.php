<?php

use App\Controllers\MailController;

return [
    'GET' => [['/mails', MailController::class, 'index']],
    'POST' => [['/mails', MailController::class, 'store']]
];
