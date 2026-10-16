<?php

namespace App\Models;

use App\Policies\ChatPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(ChatPolicy::class)]
#[Fillable(["ticket_id", "user_id", "message"])]
class Chat extends Model
{
    public function casts(): array
    {
        return [
            'ticket_id' => 'integer',
            'user_id' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
