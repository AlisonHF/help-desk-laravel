<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class NotificationController extends Controller
{
    public function read(string $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification->markAsRead();

        return redirect()->back();
    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function open(string $notification)
    {
        $notification = auth()->user()->notifications()->findOrFail($notification);

        $ticketId = $notification->data['ticket_id'];

        $ticket = Ticket::findOrFail($ticketId);

        Gate::authorize('view', $ticket);

        $notification->markAsRead();

        return to_route('ticket.view', $ticket);
    }

    public function list()
    {
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => route('notification.list'), 'name' => 'Notificações'],
        ];

        $namePage = 'Notificações';

        $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->paginate(10);

        return view('notification.list', [
            'breadcrumbs' => $breadcrumbs,
            'namePage' => $namePage,
            'notifications' => $notifications,
        ]);
    }
}
