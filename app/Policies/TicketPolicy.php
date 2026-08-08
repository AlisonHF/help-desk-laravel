<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Enums\TicketStatus;
use App\Enums\UserPositions;

class TicketPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        return $user->position === UserPositions::Admin ? true : null;
    }

    /**
     * Determine whether the user can view any models.
     * O controle é feito no controller
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $ticket->user_id === $user->id ||
            $ticket->technician_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        if ($ticket->user_id === $user->id) {
            return $ticket->status === TicketStatus::Aberto;
        }

        return $ticket->technician_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        if ($ticket->status === TicketStatus::Aberto) {
            return $ticket->user_id === $user->id;
        }

        return false;
    }
}
