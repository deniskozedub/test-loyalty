<?php

declare(strict_types=1);

namespace App\Http\Requests\Transaction;

use App\Enums\AccountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'accountId' => ['required', 'numeric', Rule::exists('loyalty_account','id')],
            'pointsAmount' => ['required', 'numeric', 'gt:0'],
            'description' => ['required', 'string'],
            'accountType' => ['required', Rule::in(AccountTypeEnum::toLabels())]
        ];
    }
}
