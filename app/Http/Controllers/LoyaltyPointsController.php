<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Factories\TransactionFactory;
use App\Http\Requests\Transaction\CancelRequest;
use App\Http\Requests\Transaction\LoyaltyPointRequest;
use App\Http\Requests\Transaction\WithdrawRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\WithdrawResource;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoyaltyPointsController extends Controller
{
    public function __construct(
        private TransactionFactory $transactionFactory,
        private TransactionService $transactionService
    ){}

    /**
     * @throws UnknownProperties
     * @throws \Exception
     */
    public function deposit(LoyaltyPointRequest $pointRequest): JsonResponse
    {
        $depositFactory = $this->transactionFactory->deposit($pointRequest);
        $transaction =  $this->transactionService->deposit($depositFactory);

        return $this->response(TransactionResource::make($transaction))->setStatusCode(Response::HTTP_CREATED);
    }

    public function cancel(CancelRequest $cancelRequest): JsonResponse
    {
        $this->transactionService->cancel(
            (int) $cancelRequest->input('transactionId'),
            $cancelRequest->input('reason')
        );

        return response()->json(['success' => true]);
    }

    /**
     * @throws \Exception
     */
    public function withdraw(WithdrawRequest $withdrawRequest): JsonResponse
    {
        if (!in_array($withdrawRequest->input('accountType'), AccountTypeEnum::toLabels())){
            throw new \InvalidArgumentException('Wrong parameters');
        }

        $transaction = $this->transactionService->withdraw(
            (int) $withdrawRequest->input('accountId'),
            (int) $withdrawRequest->input('pointsAmount'),
            $withdrawRequest->input('description'),
        );

        return $this->response(WithdrawResource::make($transaction));
    }
}
