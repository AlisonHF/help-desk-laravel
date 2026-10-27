<?php

namespace App\Events;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class TicketCreated
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Ticket $ticket,
        public User $actor
    ) {
        //
    }

}
