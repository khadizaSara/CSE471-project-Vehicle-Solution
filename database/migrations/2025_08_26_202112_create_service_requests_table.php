<?php

// database/migrations/xxxx_xx_xx_create_service_requests_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('service_type');
            $table->integer('duration_minutes')->default(30);
            $table->text('instructions')->nullable();
            $table->enum('status', ['pending', 'accepted', 'cancelled', 'completed'])->default('pending');
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
}
