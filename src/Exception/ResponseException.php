<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ResponseException extends HttpException
{
    public function __construct(string $message, int $statusCode)
    {
        parent::__construct($statusCode, $message);
    }
}
