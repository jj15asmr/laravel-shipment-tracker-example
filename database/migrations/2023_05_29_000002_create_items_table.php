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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_number')->unique();

            $table->foreignId('sender_address_id')->constrained('item_addresses');
            $table->foreignId('receiver_address_id')->constrained('item_addresses');

            $table->string('shipment_type');
            $table->decimal('weight')->comment('Pounds stored as a decimal');

            $table->string('status')->default('in_system');

            $table->date('shipped_on')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
