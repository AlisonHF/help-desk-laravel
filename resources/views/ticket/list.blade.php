@extends('Layouts.master')

@section('content')
<div class="flex flex-row flex-wrap gap-4 justify-center">
    @forelse($tickets as $ticket)
        <div class="card w-120 bg-base-200 card-xl shadow-sm mb-3">
            <div class="card-body">
                <span class="badge {{ $ticket->status->color() }}">
                    <b>{{ $ticket->status->label() }}</b>
                </span>
                
                <h2 class="card-title">{{ $ticket->title }}</h2>

                @can('is-technician')
                    <small class="block mt-2">Criado por: <b>{{ $ticket->user->name }}</b></small>
                @endcan
                
                <small class="block">
                    Criado em: 
                    <b>{{ $ticket->created_at->format('d/m/Y - h:m') }}</b>
                </small>

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
