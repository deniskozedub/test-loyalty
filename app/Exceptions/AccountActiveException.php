<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AccountActiveException extends Exception
{
    protected $message = 'Account is not active';

    public function render(): Response
    {
        return response([
            "message" => $this->message,
        ], 400);
    }
}
