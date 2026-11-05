<?php

namespace App\Listeners;

use App\Events\TicketAnswered;
use App\Models\User;
use App\Notifications\TicketAnsweredNotification;

class SendTicketAnsweredNotification
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
    public function handle(TicketAnswered $event): void
    {
        $user = $event->ticket->user;

        $technician = User::findOrFail($event->ticket->technician_id);

        if ($user->id == $event->actor->id) {
            $technician->notify(new TicketAnsweredNotification($event->ticket, $event->actor));
        } else {
            $event->ticket->user->notify(new TicketAnsweredNotification($event->ticket, $event->actor));
        }
    }
}
