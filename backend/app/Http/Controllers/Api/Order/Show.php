<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __construct(
        private OrderGetterServiceInterface $orderGetterService
    ) {}

    public function __invoke(string $id): JsonResponse
    {
        $order = $this->orderGetterService->getOne($id); 

        if (empty($order)) {
            return response()->json(status: JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json(
            ['data' => $order->toArray()]
        );
    }
}