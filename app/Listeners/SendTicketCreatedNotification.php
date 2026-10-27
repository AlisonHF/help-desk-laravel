<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Models\User;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Support\Facades\Notification;

class SendTicketCreatedNotification
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
    public function handle(TicketCreated $event): void
    {
        $recipients = User::technicians()
            ->whereKeyNot($event->actor->id)
            ->get();

        Notification::send($recipients, new TicketCreatedNotification($event->ticket, $event->actor));
    }
}
