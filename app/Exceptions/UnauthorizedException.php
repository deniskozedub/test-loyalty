<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UnauthorizedException extends Exception
{
    protected $message = 'Bad credentials';

    public function render(): Response
    {
        return response([
            "message" => $this->message,
        ], 401);
    }
}
