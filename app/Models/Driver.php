<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Driver extends User
{
    use Notifiable;

    /**
     * The "type" of user for identification.
     */
    protected $attributes = [
        'role' => 'driver',
    ];
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * Override newModelQuery to always filter by 'driver' role.
     */
    public function newQuery()
    {
        return parent::newQuery()->where('role', 'driver');
    }
}

