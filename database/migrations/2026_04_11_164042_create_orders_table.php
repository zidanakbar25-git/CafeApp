<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('table_id');
            $table->string('order_code', 50)->unique();
            $table->string('customer_name', 150)->nullable();
            $table->enum('status', ['pending', 'preparing', 'confirmed', 'completed'])
            ->default('pending');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('table_id')
                  ->references('table_id')
                  ->on('cafe_tables')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};