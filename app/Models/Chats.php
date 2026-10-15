<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(["ticket_id", "user_id", "mensage"])]
class Chats extends Model
{
    public function casts(): array
    {
        return [
            'ticket_id' => 'integer',
            'user_id' => 'integer',
        ];
    }
}
