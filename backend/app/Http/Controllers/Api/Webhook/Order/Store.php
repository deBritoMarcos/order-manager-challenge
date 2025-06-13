<?php

namespace App\Http\Controllers\Api\Webhook\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Webhook\Order\CreateRequest;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use Illuminate\Http\JsonResponse;

class Store extends Controller
{
    public function __construct(
        private ControlOrderProgressServiceInterface $controlOrderProgressService
    ) {}

    public function __invoke(CreateRequest $request): JsonResponse
    {
        $this->controlOrderProgressService
            ->register($request->orderCode);

        return response()->json(status: JsonResponse::HTTP_CREATED);
    }
}