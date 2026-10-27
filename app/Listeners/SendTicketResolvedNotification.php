<?php

namespace App\Listeners;

use App\Events\TicketResolved;
use App\Models\User;
use App\Notifications\TicketResolvedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $dest = User::find($event->ticket->user_id);

        Notification::send($dest, new TicketResolvedNotification($event->ticket, $event->actor));
    }
}
