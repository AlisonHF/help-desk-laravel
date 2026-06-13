<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function new()
    {
        return view('ticket.edit');
    }

    public function list()
    {
        return view('ticket.list');
    }
}
