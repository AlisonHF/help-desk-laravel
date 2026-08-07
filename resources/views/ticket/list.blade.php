@extends('Layouts.master')

@section('content')
<form class="grid grid-cols-2 md:grid-cols-5 gap-3 p-2">
    <div class="col-span-2 md:col-span-1">
        <fieldset class="fieldset w-full">
            <legend>Protocolo</legend>
            <label class="input input-bordered">
                <input/>
            </label>
        </fieldset>
    </div>
    <div class="col-span-2">
        <fieldset class="fieldset">
            <legend>Título do chamado</legend>
            <label class="input input-bordered w-full">
                <input/>
            </label>
        </fieldset>
    </div>
    <div class="col-span-2">
        <fieldset class="fieldset">
            <legend>Categoria</legend>
            <label class="select select-bordered">
                <select>
                    <option val="">Selecione</option>
                </select>
            </label>
        </fieldset>
    </div>
    <div>
        <fieldset class="fieldset">
            <legend>Status</legend>
            <label class="select select-bordered">
                <select>
                    <option val="">Selecione</option>
                </select>
            </label>
        </fieldset>
    </div>
    <div>
        <fieldset class="fieldset">
            <legend>Tipo de busca por data</legend>
            <label class="select select-bordered">
                <select>
                    <option val="">Selecione</option>
                </select>
            </label>
        </fieldset>
    </div>
    <div>
        <fieldset class="fieldset">
            <legend>Data inicial</legend>
            <label class="input input-bordered">
                <input type="date"/>
            </label>
        </fieldset>
    </div>
    <div>
        <fieldset class="fieldset">
            <legend>Data final</legend>
            <label class="input input-bordered">
                <input type="date"/>
            </label>
        </fieldset>
    </div>

    <div class="row-auto">
        <fieldset class="fieldset">
            <legend>&nbsp</legend>
            <button class="btn btn-info" type="submit">Pesquisar</button>
        </fieldset>
    </div>
</form>

<div class="flex w-full flex-col">
  <div class="divider mx-10"></div>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 hidden md:block">
    <table class="table">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Chamado</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Criado em</th>
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
                            {{  $ticket->status->label()  }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
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

<div class="md:hidden">
    @foreach($tickets as $ticket)
        <div class="card w-90 sm:w-110 bg-base-100 card-xs shadow-sm mb-3">
            <div class="card-body">
                <div class="justify-between flex">
                    <span class="badge {{ $ticket->status->color() }} rounded-2xl text-[10px] p-2">
                        <b>{{ $ticket->status->label() }}</b>
                    </span>
                    <span class="ml-auto">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <h2 class="card-title">{{ $ticket->title }}</h2>

                <p class="truncate">{{ $ticket->description }}</p>

                <div class="flex items-center justify-between gap-2 border-t border-base-content/10 pt-2 mt-1">
                    <span class="min-w-0 truncate">{{ $ticket->category->description }}</span>

                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('ticket.edit', $ticket->id) }}" title="Editar" class="flex hover:underline">
                            <x-heroicon-o-pencil-square class="size-4" />Editar
                        </a>
                        @can('ticket-delete')
                            <form method="POST" action="{{ route('ticket.delete', $ticket->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="flex hover:cursor-pointer text-error hover:underline" type="submit" title="Excluir">
                                    <x-heroicon-o-trash class="size-4"/>Excluir
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
