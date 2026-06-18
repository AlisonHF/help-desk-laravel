<?php

namespace App\Http\Controllers;

use App\Enums\UserPositions;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('ticket.edit', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5' , 'max:255'],
            'description' => ['required', 'string', 'min:5', 'max:255'],
            'category_id' => ['required']
        ]);

        $data['user_id'] = $this->user_id;

        $ticket = Ticket::create($data);

        return redirect()->route('ticket.new');
    }

    public function list()
    {
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

        return view('ticket.list', ['tickets' => $tickets]);
    }
}
