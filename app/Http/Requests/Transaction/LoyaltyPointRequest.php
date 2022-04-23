<?php

declare(strict_types=1);

namespace App\Http\Requests\Transaction;

use App\Enums\AccountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoyaltyPointRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'accountId' => ['required', 'numeric', Rule::exists('loyalty_account','id')],
            'pointsRule' => ['required', 'numeric', Rule::exists('loyalty_points_rule', 'id')],
            'pointsAmount' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'paymentId' => ['required', 'string'],
            'paymentAmount' => ['required', 'numeric'],
            'paymentTime' => ['required', 'numeric'],
            'accountType' => ['required', Rule::in(AccountTypeEnum::toLabels())]
        ];
    }
}
