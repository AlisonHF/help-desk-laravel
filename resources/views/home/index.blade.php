@extends('Layouts.master')

@section('content')
<h1 class="w-full px-5 pt-5 text-center bold text-2xl">Bem vindo {{ $user }}</h1>
<small class="pb-5">O que faremos hoje?</small>
<div class="flex gap-3 flex-wrap items-center justify-center">
    <x-card-home
        icon="heroicon-o-plus-circle"
        icon-class="bg-blue-100 text-blue-500"
        title="Abrir chamado"
        description="Registre um novo chamado"
        :href="route('ticket.new')" />

    <x-card-home
        icon="heroicon-o-chat-bubble-bottom-center"
        icon-class="bg-amber-100 text-amber-500"
        title="Chamados em aberto"
        description="Verifique os chamados em aberto" />
    
    <x-card-home
        icon="heroicon-o-archive-box"
        icon-class="bg-green-100 text-green-500"
        title="Histórico de chamados"
        description="Verifique todos os seus chamados"
        :href="route('ticket.list')" />
</div>
@endsection
