@extends('Layouts.master')

@section('content')
<div class="text-lg divider my-6">Histórico de chamados</div>
<div class="flex flex-row flex-wrap gap-4 justify-center">
    @forelse($tickets as $ticket)
        <div class="card w-120 bg-base-100 card-xl shadow-sm">
            <div class="card-body">
                <h2 class="card-title">{{ $ticket->title }}</h2>
                <p>{{ $ticket->description }}</p>
                <div class="card-actions">
                    <button class="btn btn-info">Visualizar</button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Nenhum chamado encontrado...</p>
    @endforelse
</div>
@endsection
