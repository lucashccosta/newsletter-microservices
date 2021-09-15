<?php

namespace Libs\Core\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    protected $message = 'Bad request';
    protected $code = 400;
}
