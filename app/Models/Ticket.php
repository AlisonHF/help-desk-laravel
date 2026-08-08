<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Policies\TicketPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(TicketPolicy::class)]
#[Fillable(['title', 'description', 'category_id', 'user_id', 'technician_id', 'status', 'completed_in'])]
class Ticket extends Model
{
    protected function casts()
    {
        return [
            'user_id' => 'integer',
            'technician_id' => 'integer',
            'category_id' => 'integer',
            'status' => TicketStatus::class
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
