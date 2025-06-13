<?php

namespace App\Http\Controllers\Api\Webhook\Order;

use App\Data\Order\OrderData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Webhook\Order\CreateRequest;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use Illuminate\Http\JsonResponse;

class Create extends Controller
{
    public function __construct(
        private OrderEloquentRepositoryInterface $orderRepository
    ) {}

    public function __invoke(CreateRequest $request): JsonResponse
    {
        $orderData = OrderData::fromWebhook($request);

        $this->orderRepository->create($orderData->toArray());

        return response()->json(status: JsonResponse::HTTP_OK);
    }
}