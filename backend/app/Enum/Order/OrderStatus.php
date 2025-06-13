<?php

namespace App\Enum\Order;

enum OrderStatus {
    case Pending;
    case Started;
    case Finished;
}
