<?php

namespace App\Listeners;

use App\Events\TicketResolved;
use App\Notifications\TicketResolvedNotification;

class SendTicketResolvedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketResolved $event): void
    {
        if ($event->ticket->user_id === $event->actor->id) {
            return;
        }

        $event->ticket->user->notify(new TicketResolvedNotification($event->ticket, $event->actor));
    }
}
