<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function read(string $id)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);

            $notification->markAsRead();

            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e->getCode().'|'.$e->getMessage(), [$e]);

            return redirect()
                ->back()
                ->with('error', 'Não foi possível marcar como lida sua notificação, entre em contato com o suporte técnico');
        }
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
