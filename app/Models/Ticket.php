<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'category_id', 'user_id', 'technician_id', 'status', 'completed_in'])]
class Ticket extends Model
{
    protected function casts()
    {
        return [
            'status' => TicketStatus::class
        ];
    }

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function technician()
    {
        return $this->hasMany(User::class, 'technician_id');
    }
}
