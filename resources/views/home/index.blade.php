@extends('Layouts.master')

@section('content')

<div class="flex gap-5">
    <x-card-home class="bg-blue-600 text-white">
        <div>
            <x-heroicon-o-plus-circle class="size-11 mr-3" />
        </div>
        <div>
            <h2 class="font-bold">Abrir chamado</h2>
        </div>
    </x-card-home>

    <x-card-home class="bg-info text-white text-center">
        <div>
            <x-heroicon-o-chat-bubble-bottom-center class="size-11 mr-3" />
        </div>
        <div>
            <h2 class="font-bold">Chamados em aberto</h2>
        </div>
    </x-card-home>

    <x-card-home class="bg-accent text-white text-center">
        <div>
            <x-heroicon-o-archive-box class="size-11 mr-3" />
        </div>
        <div>
            <h2 class="font-bold">Histórico de chamados</h2>
        </div>
    </x-card-home>
</div>

@endsection
