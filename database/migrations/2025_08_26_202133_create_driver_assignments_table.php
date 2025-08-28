<?php

// database/migrations/xxxx_xx_xx_create_driver_assignments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('driver_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_request_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->enum('assignment_status', ['pending', 'assigned', 'en_route', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('service_request_id')->references('id')->on('service_requests')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_assignments');
    }
}

