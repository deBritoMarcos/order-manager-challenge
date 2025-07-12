<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('code');
            $table->enum('status', ['pending', 'started', 'finished'])->default('pending');
            $table->mediumText('description')->nullable();
            $table->foreignUuid('responsable_id')->nullable();
            $table->timestamps();

            $table->foreign('responsable_id')
                ->references('id')
                ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
