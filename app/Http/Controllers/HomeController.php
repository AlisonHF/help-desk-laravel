<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user()->name;

        return view('home.index', ['user' => $user]);
    }
}
