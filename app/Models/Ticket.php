<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Enums\UserPositions;
use App\Policies\TicketPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

#[UsePolicy(TicketPolicy::class)]
#[Fillable(['title', 'description', 'category_id', 'user_id', 'technician_id', 'status', 'completed_in'])]
class Ticket extends Model
{
    use HasFactory;

    protected function casts()
    {
        return [
            'user_id' => 'integer',
            'technician_id' => 'integer',
            'category_id' => 'integer',
            'status' => TicketStatus::class,
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

    public function changeStatus(User $user)
    {
        $statusTicket = $this->status;
        $newStatus = '';
        $positionUser = $user->position;

        switch ($positionUser) {
            case UserPositions::Admin:
            case UserPositions::Tecnico:
                if ($statusTicket === TicketStatus::Aberto || $statusTicket === TicketStatus::EmAndamento) {
                    $this->update(['status' => TicketStatus::AguardandoUsuario]);
                    $newStatus = TicketStatus::AguardandoUsuario;
                }

                break;
            case UserPositions::Usuario:
                if ($statusTicket === TicketStatus::AguardandoUsuario) {
                    $this->update(['status' => TicketStatus::EmAndamento]);
                    $newStatus = TicketStatus::EmAndamento;
                }
        }

        Log::info("Ticket $this->id teve seu status alterado de $statusTicket->value para $newStatus->value");
    }
}
