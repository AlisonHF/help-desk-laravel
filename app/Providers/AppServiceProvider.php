<?php

namespace App\Providers;

use App\Enums\TicketStatus;
use App\Enums\UserPositions;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('ticket-delete', fn (User $user) => 
            $user->position == UserPositions::Admin
        );

        Gate::define('ticket-update', fn (User $user, Ticket $ticket) =>
            $user->position == UserPositions::Admin ||
            $ticket->status == TicketStatus::Aberto ||
            $ticket->technician_id == $user->id
        );
    }
}
