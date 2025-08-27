<?php

namespace App\Models;

class Customer extends User
{
    /**
     * The "type" of user for identification.
     */
    protected $attributes = [
        'role' => 'customer',
    ];
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];
    /**
     * Override newModelQuery to always filter by 'customer' role.
     */
    public function newQuery()
    {
        return parent::newQuery()->where('role', 'customer');
    }
}
