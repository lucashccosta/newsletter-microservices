<?php

namespace Libs\Core\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Api resource not found';
    protected $code = 404;
}
