<?php

namespace App\Models;

use App\Enums\TicketStatus;
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

        if ($user->id == $this->technician_id) {
            $newStatus = TicketStatus::AguardandoUsuario;
        } else {
            $newStatus = TicketStatus::EmAndamento;
        }

        if ($newStatus != $this->status) {
            $this->update(['status' => $newStatus]);

            Log::info("Ticket #$this->id teve seu status alterado de $statusTicket->value para $newStatus->value");
        }
    }

    public function assignTechnician(User $user)
    {
        if ($this->technician_id) {
            return;
        }

        $this->update(['technician_id' => $user->id]);

        Log::info("Ticket #$this->id teve o técnico $user->id atribuido.");

    }
}
