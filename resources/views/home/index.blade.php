@extends('Layouts.master')

@section('content')
<h1 class="w-full px-5 pt-5 text-center bold text-2xl">Bem vindo {{ $user }}</h1>
<small class="pb-5">O que faremos hoje?</small>
<div class="flex gap-3 flex-wrap items-center justify-center mb-3">
    <x-card-home
        icon="heroicon-o-plus-circle"
        icon-class="bg-primary/10 text-primary-dark"
        title="Abrir chamado"
        description="Registre um novo chamado"
        :href="route('ticket.new')" />

    <x-card-home
        icon="heroicon-o-chat-bubble-bottom-center"
        icon-class="bg-secondary/15 text-secondary-dark"
        title="Chamados em aberto"
        description="Verifique os chamados em aberto" />

    <x-card-home
        icon="heroicon-o-archive-box"
        icon-class="bg-accent/15 text-accent-dark"
        title="Histórico de chamados"
        description="Verifique todos os seus chamados"
        :href="route('ticket.list')" />
</div>
@endsection
