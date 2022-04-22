<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Factories\AccountFactory;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AccountController extends Controller
{

    public function __construct(
        private AccountFactory $accountFactory,
        private AccountService $accountService
    ){}

    /**
     * @throws UnknownProperties
     */
    public function store(AccountRequest $accountRequest): JsonResponse
    {
        $accountFactory = $this->accountFactory->create($accountRequest);
        $account =  $this->accountService->create($accountFactory);

        return $this->response(AccountResource::make($account))->setStatusCode(Response::HTTP_CREATED);
    }

    public function changeStatus($type, $id): JsonResponse
    {
        if (!in_array($type, AccountTypeEnum::toLabels())){
            throw new \InvalidArgumentException('Wrong parameters');
        }

        $this->accountService->activate($id);

        return response()->json(['success' => true]);
    }

    public function balance($type, $id): JsonResponse
    {
        if (!in_array($type, AccountTypeEnum::toLabels())){
            throw new \InvalidArgumentException('Wrong parameters');
        }

        $balance = $this->accountService->getBalance($id);

        return response()->json(['balance' => $balance]);
    }
}
