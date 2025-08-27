<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCustomerForeignKeyOnServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Drop old foreign key referencing users table
            $table->dropForeign(['customer_id']);
            // Add new foreign key referencing customers table
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Drop foreign key referencing customers table
            $table->dropForeign(['customer_id']);
            // Revert foreign key referencing users table
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
