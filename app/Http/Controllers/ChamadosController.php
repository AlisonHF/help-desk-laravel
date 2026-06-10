<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChamadosController extends Controller
{
    public function new()
    {
        return view('chamados.edit');
    }

    public function list()
    {
        return view('chamados.list');
    }
}
