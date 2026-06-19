<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());

        $namePage = "Seja bem vindo $user->name !";

        return view('home.index', ['namePage' => $namePage]);
    }
}
