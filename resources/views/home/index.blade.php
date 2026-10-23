@extends('Layouts.master')

@section('content')
<div class="mx-5 my-3 w-fit">
    <h2 class="font-semibold tracking-tight text-2xl">Bem vindo {{ $user }}</h2>
    <small class="pb-5 text-ink-muted">O que faremos hoje?</small>
</div>
<div class="grid grid-flow-col grid-rows-1 gap-5 mx-5">
    <x-card-home
        icon="heroicon-o-plus-circle"
        icon-class="bg-primary/10 text-primary-dark"
        title="Abrir chamado"
        description="Registre um novo chamado"
        :href="route('ticket.new')" />

    <x-card-home
        icon="heroicon-o-chat-bubble-bottom-center"
        icon-class="bg-secondary/15 text-secondary-dark"
        title="Chamados em andamento"
        description="Verifique os chamados em andamento"
        :href="route('ticket.list', ['situacao' => 'ativos'])" />

    <x-card-home
        icon="heroicon-o-archive-box"
        icon-class="bg-accent/15 text-accent-dark"
        title="Histórico de chamados"
        description="Verifique todos os seus chamados"
        :href="route('ticket.list')" />
</div>
@endsection
