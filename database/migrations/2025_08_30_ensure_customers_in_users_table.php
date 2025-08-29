<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up()
    {
        // Copy all customers to users table if not already present
        $customers = DB::table('customers')->get();
        foreach ($customers as $customer) {
            $exists = DB::table('users')->where('email', $customer->email)->exists();
            if (!$exists) {
                DB::table('users')->insert([
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'password' => isset($customer->password) ? $customer->password : Hash::make('password'),
                    'role' => 'customer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down()
    {
        // Optionally, remove users that were added by this migration
        $customers = DB::table('customers')->get();
        foreach ($customers as $customer) {
            DB::table('users')->where('email', $customer->email)->where('role', 'customer')->delete();
        }
    }
};
