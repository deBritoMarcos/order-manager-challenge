<?php

namespace App\Http\Controllers\Api\Order\Situation;

use App\Http\Controllers\Controller;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Http\JsonResponse;

class Update extends Controller
{
    public function __construct(
        private ControlOrderProgressServiceInterface $controlOrderProgressService,
        private OrderGetterServiceInterface $orderGetterService,
    ) {}

    public function __invoke(string $id): JsonResponse
    {
        $order = $this->orderGetterService->getOne($id); 
            
        if (empty($order)) {
            return response()->json(status: JsonResponse::HTTP_NOT_FOUND);
        }

        $this->controlOrderProgressService->update($order);

        return response()->json();
    }
}