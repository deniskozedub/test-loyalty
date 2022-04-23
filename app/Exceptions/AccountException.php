<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AccountException extends Exception
{
    protected $message = 'Account not found';

    public function render(): Response
    {
        return response([
            "message" => $this->message,
        ], 400);
    }
}
