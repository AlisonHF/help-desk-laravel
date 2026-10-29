<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function read(string $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification->markAsRead();

        return redirect()->route('ticket.view', $notification->data['ticket_id']);
    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function list()
    {
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => route('notification.list'), 'name' => 'Notificações'],            
        ];

        $namePage = 'Notificações';

        $notifications = auth()->user()->notifications()->orderBy('created_at','desc')->paginate(10);

        return view('notification.list', [
            'breadcrumbs' => $breadcrumbs,
            'namePage' => $namePage,
            'notifications' => $notifications
        ]);
    }
}
