<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Enums\UserPositions;
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
            'message' => ['required', 'string', 'min:10', 'max:10000']
        ]);

        try {
            $user_id = auth()->id();
            $ticket_id = $ticket->id;

            $chat = Chat::create([
                'user_id' => $user_id,
                'ticket_id'=> $ticket_id,
                'message' => $data['message']
            ]);

            $this->changeStatus($ticket);

            Log::info("Resposta $chat->id registrada para o ticket: $ticket_id | criado pelo usuario: $user_id");

            return redirect()->route('ticket.list')->with('success', 'Resposta cadastrada com sucesso!');

        } catch (Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());
            
            return redirect()->route('ticket.list')
                ->with('error', '(300) Não foi possível registrar a resposta, entre em contato com nosso suporte técnico!');
        }
    }

    private function changeStatus(Ticket $ticket)
    {
        try {
            $statusTicket = $ticket->status;
            $newStatus = '';
            $positionUser = auth()->user()->position;
     
            switch ($positionUser) {
                case (UserPositions::Admin):
                case (UserPositions::Technician): 
                    if ($statusTicket === TicketStatus::Aberto || $statusTicket === TicketStatus::EmAndamento) {
                        $ticket->update(['status' => TicketStatus::AguardandoUsuario]);
                        $newStatus = TicketStatus::AguardandoUsuario;
                    }

                    break;
                case (UserPositions::User):
                    if ($statusTicket === TicketStatus::AguardandoUsuario) {
                        $ticket->update(['status' => TicketStatus::EmAndamento]);
                        $newStatus = TicketStatus::EmAndamento;
                    }
            }

            Log::info("Ticket $ticket->id teve seu status alterado de $statusTicket->value para $newStatus->value");
        } catch(Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());
        
            return redirect()->route('ticket.list')
                ->with('error', '(400) Não foi possível registrar a resposta, entre em contato com nosso suporte técnico!');
        }
    }
}
