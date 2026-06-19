@extends('Layouts.master')

@section('content')

<div class="flex justify-center items-center gap-5 my-20">
    <a href="{{ route('ticket.new') }}">
        <x-card-home class="bg-info-content text-white">
            <div>
                <x-heroicon-o-plus-circle class="size-11 mr-3" />
            </div>
            <div>
                <h2 class="font-bold">Abrir chamado</h2>
            </div>
        </x-card-home>
    </a>

    <x-card-home class="bg-neutral text-white text-center">
        <div>
            <x-heroicon-o-chat-bubble-bottom-center class="size-11 mr-3" />
        </div>
        <div>
            <h2 class="font-bold">Chamados em aberto</h2>
        </div>
    </x-card-home>

    <a href="{{ route('ticket.list') }}">
        <x-card-home class="bg-success-content text-white text-center">
            <div>
                <x-heroicon-o-archive-box class="size-11 mr-3" />
            </div>
            <div>
                <h2 class="font-bold">Histórico de chamados</h2>
            </div>
        </x-card-home>
    </a>

    <form class="contents" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            <x-card-home class="bg-error-content text-white text-center hover:cursor-pointer">
                <div>
                    <x-heroicon-o-arrow-left-end-on-rectangle class="size-11 mr-3" />
                </div>
                <div>
                    <h2 class="font-bold">Sair</h2>
                </div>
            </x-card-home>
        </button>
    </form>
</div>

@endsection
