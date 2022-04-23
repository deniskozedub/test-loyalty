<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class BalanceException extends Exception
{
    protected $message = 'Insufficient funds';

    public function render(): Response
    {
        return response([
            "message" => $this->message,
        ], 400);
    }
}
