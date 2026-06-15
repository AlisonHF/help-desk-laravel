<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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

        $data['user_id'] = auth()->id();

        $ticket = Ticket::create($data);

        return redirect()->route('ticket.new');
    }

    public function list()
    {
        return view('ticket.list');
    }
}
