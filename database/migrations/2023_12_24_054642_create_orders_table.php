<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->string('order_track_id')->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->decimal('subtotal');
            $table->decimal('discount')->default(0);
            $table->decimal('tax')->nullable();
            $table->decimal('total')->default(0);
            $table->decimal('total_paid')->default(0);
            $table->decimal('total_due')->default(0);
            $table->decimal('delivery_charge')->default(0);
            $table->enum('status',['pending','confirmed','shipped','delivered','completed','returned','cancelled'])->default('pending');
            $table->boolean('is_shipping_different')->default(false);
            $table->string('order_from')->nullable();
            $table->date('canceled_date')->nullable();
            $table->tinyInteger('return_confirm')->default(1);
            $table->longText('comment')->nullable();
            $table->tinyInteger('is_pos')->default(0);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
