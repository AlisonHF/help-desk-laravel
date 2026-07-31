@extends('Layouts.master')

@section('content')

{{-- <div class="flex flex-row flex-wrap gap-4 justify-center">
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
</div> --}}

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Chamado</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <th>{{ $ticket->id }}</th>
                    <td class="sm:w-80">{{ $ticket->title }}</td>
                    <td class="sm:w-40">{{ $ticket->category->description }}</td>
                    <td class="sm:w-50 min-w-40">
                        <span class="badge {{ $ticket->status->color() }} rounded-2xl">
                            <b>{{ $ticket->status->label() }}</b>
                        </span>
                    </td>
                    <td class="flex flex-row gap-1 sm:w-20">
                        <a href="{{ route('ticket.edit', $ticket->id) }}" title="Editar">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </a>
                        @can('ticket-delete')
                            <form method="POST" action="{{ route('ticket.delete', $ticket->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="hover:cursor-pointer" type="submit" title="Excluir">
                                    <x-heroicon-o-trash class="size-5 text-red-600"/>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
