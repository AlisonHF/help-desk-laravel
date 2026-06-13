<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
    {
        return $this->hasMany(User::class, 'user');
    }

    public function technician()
    {
        return $this->hasMany(User::class, 'technician');
    }
}
