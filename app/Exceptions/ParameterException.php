<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ParameterException extends Exception
{
    protected $message = 'Wrong parameters';

    public function render(): Response
    {
        return response([
            "message" => $this->message,
        ], 400);
    }
}
