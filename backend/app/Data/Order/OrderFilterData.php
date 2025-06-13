<?php

namespace App\Data\Order;

use App\Data\DataInterface;
use App\Enum\Order\OrderStatus;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class OrderFilterData extends Data implements DataInterface
{
    public function __construct(
        public ?int $code,
        public ?OrderStatus $status,
    ) {
    }

    public static function fromQueryParams(?int $codeParam, ?string $statusParam): OrderFilterData
    {
        $status = self::sanitizeAndCast($statusParam);

        return new self(
            $codeParam,
            $status
        );
    }

    private static function sanitizeAndCast(?string $value): ?OrderStatus
    {
        if (empty($value)) {
            return null;
        }

        $value = trim(strtolower(strip_tags($value)));

        try {
            return OrderStatus::tryFrom($value);
        } catch (\Throwable $th) {
            return null;
        }
    }
}