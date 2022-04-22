<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\AuthFactory;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\AuthResource;
use App\Http\Requests\User\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    public function __construct(
        private AuthFactory $authFactory,
        private AuthService $authService
    ) {}

    /**
     * @throws UnknownProperties
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $registerFactory = $this->authFactory->register($registerRequest);
        $user = $this->authService->register($registerFactory);

        return $this->response(AuthResource::make($user))->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(LoginRequest $loginRequest)
    {
        $loginFactory = $this->authFactory->login(
                            $loginRequest->input('email'),
                            $loginRequest->input('password')
                        );
        $user = $this->authService->login($loginFactory);

        return $this->response(AuthResource::make($user));
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);

        return $this->response(['message' => 'Logged out']);
    }
}
