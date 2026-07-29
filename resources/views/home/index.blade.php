@extends('Layouts.master')

@section('content')
<h1 class="w-full px-5 pt-5 text-center bold text-2xl">Bem vindo {{ $user }}</h1>
<small class="pb-5">O que faremos hoje?</small>
<div class="flex gap-3 flex-wrap items-center justify-center">
    <div class="card w-70 bg-base-100 card-sm shadow-sm">
        <div class="card-body">
            <div class="rounded bg-blue-100 w-min">
                <x-heroicon-o-plus-circle class="size-8 m-1 text-blue-500" />
            </div>
            <h2 class="card-title">Abrir chamado</h2>
            <p>Registre um novo chamado</p>
            <div class="card-actions mt-1 hover:underline">
                <a href="{{ route('ticket.new') }}" class="text-blue-700 ">Acessar →</a>
            </div>
        </div>
    </div>

    <div class="card w-70 bg-base-100 card-sm shadow-sm">
        <div class="card-body">
            <div class="rounded bg-amber-100 w-min">
                <x-heroicon-o-chat-bubble-bottom-center class="size-8 m-1 text-amber-500" />
            </div>
            <h2 class="card-title">Chamados em aberto</h2>
            <p>Verifique os chamados em aberto</p>
            <div class="card-actions mt-1">
                <a href="#" class="text-blue-700 hover:underline">Acessar →</a>
            </div>
        </div>
    </div>

    <div class="card w-70 bg-base-100 card-sm shadow-sm">
        <div class="card-body">
            <div class="rounded bg-green-100 w-min">
                <x-heroicon-o-archive-box class="size-8 m-1 text-green-500" />
            </div>
            <h2 class="card-title">Histórico de chamados</h2>
            <p>Verifique todos os seus chamados</p>
            <div class="card-actions mt-1">
                <a href="{{ route('ticket.list') }}" class="text-blue-700 hover:underline">Acessar →</a>
            </div>
        </div>
    </div>
</div>
@endsection
