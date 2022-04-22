<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', Rule::unique('loyalty_account','email'), 'min:10'],
            'card' => ['required', Rule::unique('loyalty_account','card'), 'min:16'],
            'email' => ['required', 'email', Rule::unique('loyalty_account','email'),]
        ];
    }
}
