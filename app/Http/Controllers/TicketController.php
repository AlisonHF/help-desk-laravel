<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Enums\TicketStatusGroup;
use App\Enums\UserPositions;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Ticket;
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

    public function list(Request $request)
    {
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => '', 'name' => 'Chamados'],
        ];

        $namePage = 'Listagem de chamados';

        $tickets = null;

        $userPosition = auth()->user()->position;

        $query = Ticket::query();

        switch ($userPosition) {
            case UserPositions::Admin:
                break;
            case UserPositions::Tecnico:
                $tickets = $query->where(function ($q) {
                    $q->where('technician_id', $this->user_id)
                        ->orWhere('status', TicketStatus::Aberto);
                });
                break;
            default:
                $tickets = $query->where('user_id', $this->user_id);
                break;
        }

        // Filtros

        if ($request->filled('protocolo')) {
            $query->where('id', $request->input('protocolo'));
        }
        if ($request->filled('titulo')) {
            $query->whereLike('title', '%' . $request->input('titulo') . '%');
        }
        if ($request->filled('categoria')) {
            $query->where('category_id', $request->input('categoria'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('situacao')) {
            $group = TicketStatusGroup::tryFrom($request->input('situacao'));

            if (!empty($group)) {
                $query->whereIn('status', $group->statuses());
            }
        }
        if ($request->filled('data_in')) {
            $query->whereDate('created_at', '>=', $request->input('data_in'));
        }
        if ($request->filled('data_fin')) {
            $query->whereDate('created_at', '<=', $request->input('data_fin'));
        }

        $tickets = $query->paginate()->withQueryString();

        return view(
            'ticket.list',
            [
                'tickets' => $tickets,
                'breadcrumbs' => $breadcrumbs,
                'namePage' => $namePage,
                'categories' => Category::all(),
                'statuses' => TicketStatus::cases(),
                'groupStatus' => TicketStatusGroup::cases()
            ]
        );
    }

    public function view(Ticket $ticket)
    {
        $breadcrumbs = [
            ['href' => route('home'), 'name' => 'Home'],
            ['href' => route('ticket.list'), 'name' => 'Chamados'],
            ['href' => '', 'name' => 'Visualizar chamado'],
        ];

        $chats = Chat::where(['ticket_id' => $ticket->id])->orderBy('created_at', 'asc')->get();

        return view(
            'ticket.view',
            [
                'breadcrumbs' => $breadcrumbs,
                'ticket' => $ticket,
                'namePage' => 'Visualizar chamado',
                'chats' => $chats
            ]
        );
    }

    public function edit(Ticket $ticket)
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
                'ticket' => $ticket,
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

    public function delete(Ticket $ticket)
    {
        try {
            $id = $ticket->id;

            $ticket->delete();
    
            Log::info("Ticket: $id | deletado por: $this->user_id");

            return redirect('ticket')->with('success', 'Chamado excluído com sucesso!');
        } catch(Exception $e) {
            Log::error($e->getCode() . ' | ' . $e->getMessage());

            return redirect('ticket')
                ->with('error', 'Não foi possível excluir o chamado, entre em contato com nosso suporte técnico!');
        }
    }

    public function resolveCall(Ticket $ticket)
    {
        try {
            $ticket->update([
                'status' => TicketStatus::Resolvido
            ]);

            return redirect('ticket')
                ->with('success', 'O chamado foi resolvido com sucesso!');
        } catch(Exception $e) {
            Log::error($e->getCode() . ' | '. $e->getMessage());

            return redirect('ticket')
                ->with('error', 'Não foi possível excluir o chamado, entre em contato com nosso suporte técnico!');
        }
    }
}
