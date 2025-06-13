<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function __construct(
        private OrderGetterServiceInterface $orderGetterService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $ordersCollection = $this->orderGetterService
            ->getFiltering(
                $request->query('code'),
                $request->query('status')
            );

        return response()->json(
            ['data' => $ordersCollection->toArray()]
        );
    }
}