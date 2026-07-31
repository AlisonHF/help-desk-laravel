<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tickets()
    {
        $this->hasMany(Ticket::class);
    }
}
