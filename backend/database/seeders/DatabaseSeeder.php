<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'user@gmail.com',
            'password' => 'password',
        ]);

        Order::factory(count: 3)->create();
    }
}
