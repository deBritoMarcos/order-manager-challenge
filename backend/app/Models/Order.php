<?php

namespace App\Models;

use App\Enum\Order\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids, HasFactory;
    
    protected $fillable = [
        'code',
        'status',
        'description',
        'responsable_id',
    ];

    protected $casts = [
        'code' => 'integer',
        'status' => OrderStatus::class,
    ];
}
