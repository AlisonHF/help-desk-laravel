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
}
