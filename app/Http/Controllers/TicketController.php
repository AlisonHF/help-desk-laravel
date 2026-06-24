<?php

namespace App\Http\Controllers;

use App\Enums\UserPositions;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    private int $user_id;

    public function __construct()
    {
        $this->user_id = auth()->id();
    }

    public function new()
    {
        $categories = Category::all();

        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => route('ticket.list'), 'name' => 'Chamados'],
            ['href' => '', 'name' => 'Novo chamado'],
        ];

        $namePage = 'Abrir chamado';

        return view(
            'ticket.edit',
            [
                'categories' => $categories,
                'breadcrumbs' => $breadcrumbs,
                'namePage' => $namePage
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5' , 'max:255'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'category_id' => ['required']
        ]);

        try {
            $data['user_id'] = $this->user_id;
    
            $ticket = Ticket::create($data);

            Log::info("Ticket: $ticket->id | criado pelo usuario: $this->user_id");
    
            return redirect()->route('ticket.list')->with('success', 'Chamado cadastrado com sucesso!');
        } catch (Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());
            
            return redirect()->route('ticket.new')
                ->with('error', 'Não foi possível criar o chamado, entre em contato com nosso suporte técnico!');
        }

    }

    public function list()
    {
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => '', 'name' => 'Chamados'],
        ];

        $namePage = 'Listagem de chamados';

        $tickets = null;

        $user = User::find($this->user_id);

        switch ($user->position) {
            case UserPositions::Admin->value:
                $tickets = Ticket::get();
                break;
            case UserPositions::Technician->value:
                $tickets = Ticket::where('technician_id', $this->user_id)->get();
                break;
            default:
                $tickets = Ticket::where('user_id', $this->user_id)->get();
                break;
        }

        return view(
            'ticket.list',
            [
                'tickets' => $tickets,
                'breadcrumbs' => $breadcrumbs,
                'namePage' => $namePage
            ]
        );
    }

    public function edit(Ticket $id)
    {
        $categories = Category::all();
        
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => route('ticket.list'), 'name' => 'Chamados'],
            ['href' => '', 'name' => 'Editar chamado'],
        ];

        $namePage = 'Editar chamado';
        return view(
            'ticket.edit',
            [
                'ticket' => $id,
                'breadcrumbs' => $breadcrumbs,
                'namePage' => $namePage,
                'categories' => $categories
            ]
        ); 
    }

    public function update(Request $request, Ticket $ticket)
    {
        try {
            $data = $request->validate([
                'title' => ['required', 'string', 'min:5' , 'max:255'],
                'description' => ['required', 'string', 'min:5', 'max:255'],
                'category_id' => ['required']
            ]);
    
            $ticket->update($data);

            Log::info("Ticket: $ticket->id | atualizado por: $this->user_id");

            return redirect('ticket')->with('success', 'Chamado atualizado com sucesso!');
        } catch(Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());

            return redirect('ticket')
                ->with('error', 'Não foi possível atualizar o chamado, entre em contato com nosso suporte técnico!');
        }

    }

    public function delete(int $id)
    {
        try {
            Ticket::findOrFail($id)->delete();
    
            Log::info("Ticket: $id | deletado por: $this->user_id");

            return redirect('ticket')->with('success', 'Chamado excluído com sucesso!');
        } catch(Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());

            return redirect('ticket')
                ->with('error', 'Não foi possível excluir o chamado, entre em contato com nosso suporte técnico!');
        }
    }
}
