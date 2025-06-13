<?php

namespace App\Enum\Order;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Started = 'started';
    case Finished = 'finished';
}
