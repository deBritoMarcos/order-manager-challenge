<?php

namespace App\Http\Controllers\Api\Order\Situation;

use App\Data\Order\OrderData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\Situation\UpdateRequest;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Http\JsonResponse;

class Update extends Controller
{
    public function __construct(
        private ControlOrderProgressServiceInterface $controlOrderProgressService,
        private OrderGetterServiceInterface $orderGetterService,
    ) {}

    public function __invoke(UpdateRequest $request): JsonResponse
    {
        $order = $this->orderGetterService->getOne($request->id); 
            
        if (empty($order)) {
            return response()->json(status: JsonResponse::HTTP_NOT_FOUND);
        }

        $newOrderData = new OrderData(
            code: $order->code,
            status: $order->status,
            description: $request->validated('description'),
            responsableId: $request->validated('responsable_id'),
        );

        $this->controlOrderProgressService->update($order, $newOrderData);

        return response()->json();
    }
}