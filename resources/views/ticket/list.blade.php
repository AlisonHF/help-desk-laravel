@extends('Layouts.master')

@section('content')
<div class="flex flex-row flex-wrap gap-4 justify-center">
    @forelse($tickets as $ticket)
        <div class="card w-120 bg-base-100 card-xl shadow-sm">
            <div class="card-body">
                <h2 class="card-title">{{ $ticket->title }}</h2>
                <p>{{ $ticket->description }}</p>
                <div class="card-actions">
                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-info">Visualizar</a>
                    
                    @can('ticket-delete')
                        <form method="POST" action="{{ route('ticket.delete', $ticket->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-error" type="submit">Excluir</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Nenhum chamado encontrado...</p>
    @endforelse
</div>
@endsection
