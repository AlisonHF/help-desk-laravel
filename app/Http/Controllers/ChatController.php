<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'min:10', 'max:10000'],
        ]);

        try {
            $user = auth()->user();
            $ticket_id = $ticket->id;

            $chat = Chat::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket_id,
                'message' => $data['message'],
            ]);

            $ticket->assignTechnician($user);

            $ticket->changeStatus($user);

            Log::info("Resposta $chat->id registrada para o ticket: $ticket_id | criado pelo usuario: $user->id");

            return redirect()->route('ticket.list')->with('success', 'Resposta cadastrada com sucesso!');
        } catch (Exception $e) {
            Log::error($e->getCode().' | '.$e->getMessage());

            return redirect()->route('ticket.list')
                ->with('error', '(300) Não foi possível registrar a resposta, entre em contato com nosso suporte técnico!');
        }
    }
}
