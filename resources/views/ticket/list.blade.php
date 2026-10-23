@extends('Layouts.master')

@section('content')
<div class="w-full px-20 py-5">
    <form class="grid grid-cols-4 md:grid-cols-4 gap-3" method="GET" action="{{ route('ticket.list') }}">
        <div class="col-span-2 md:col-span-1">
            <fieldset class="fieldset w-full">
                <legend>Protocolo</legend>
                <label class="input input-bordered w-full">
                    <input id="protocolo" name="protocolo"/>
                </label>
            </fieldset>
        </div>
        <div class="col-span-2">
            <fieldset class="fieldset">
                <legend>Título do chamado</legend>
                <label class="input input-bordered w-full">
                    <input id="titulo" name="titulo"/>
                </label>
            </fieldset>
        </div>
        <div class="col-span-2">
            <fieldset class="fieldset">
                <legend>Categoria</legend>
                <label class="select select-bordered w-full">
                    <select id="categoria" name="categoria">
                        <option value="">Selecione</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category['id'] }}"
                                @selected(request('categoria') == $category['id'])
                            >
                                {{ $category['description'] }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </fieldset>
        </div>
        <div class="col-span-1">
            <fieldset class="fieldset">
                <legend>Status</legend>
                <label class="select select-bordered w-full">
                    <select id="status" name="status">
                        <option value="">Selecione</option>
                        @foreach ($statuses as $status)
                            <option
                                value="{{ $status->value }}"
                                @selected(request('status') == $status->value)
                            >
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </fieldset>
        </div>
        <div class="col-span-1">
            <fieldset class="fieldset">
                <legend>Situação</legend>
                <label class="select select-bordered w-full">
                    <select name="situacao">
                        <option value="">Selecione</option>
                        @foreach ($groupStatus as $group)
                            <option 
                                value="{{ $group->value }}"
                                @selected(request('situacao') == $group->value)
                            >{{ $group->label() }}</option>
                        @endforeach
                    </select>
                </label>
            </fieldset>
        </div>
        <div class="col-span-1">
            <fieldset class="fieldset">
                <legend>Data inicial</legend>
                <label class="input input-bordered w-full">
                    <input type="date" id="data_in" name="data_in"/>
                </label>
            </fieldset>
        </div>
        <div class="col-span-1">
            <fieldset class="fieldset">
                <legend>Data final</legend>
                <label class="input input-bordered w-full">
                    <input type="date" id="data_fin" name="data_fin"/>
                </label>
            </fieldset>
        </div>
        <div class="col-span-2">
            &nbsp
        </div>
        <div class="col-span-1">
            <fieldset class="fieldset">
                <legend>&nbsp</legend>
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </fieldset>
        </div>
    </form>
</div>

<div class="flex w-full flex-col">
    <div class="divider mx-10"></div>
</div>

@if(!$tickets->isEmpty())
    <div class="w-full">
        <div class="overflow-x-auto rounded-box border border-base-content/10 bg-base-100 hidden md:block mx-10">
            <table class="table">
                <thead class="text-ink-muted">
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
                        <tr class="hover:bg-base-200 transition-colors">
                            <th class="tabular-nums font-medium text-ink-muted">{{ $ticket->id }}</th>
                            <td class="sm:w-80 font-medium">{{ $ticket->title }}</td>
                            <td class="sm:w-40 text-ink-muted">{{ $ticket->category->description }}</td>
                            <td class="sm:w-50 min-w-40">
                                <span class="badge {{ $ticket->status->color() }}">
                                    {{  $ticket->status->label()  }}
                                </span>
                            </td>
                            <td class="text-ink-muted tabular-nums">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td class="flex flex-row gap-1 h-20 items-center">
                                @can('view', $ticket)
                                    <a href="{{ route('ticket.view', $ticket->id) }}" title="Visualizar"
                                       class="text-ink-faint hover:text-primary transition-colors">
                                        <x-heroicon-o-eye class="size-5" />
                                    </a>
                                @endcan

                                @can('update', $ticket)
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" title="Editar"
                                       class="text-ink-faint hover:text-primary transition-colors">
                                        <x-heroicon-o-pencil-square class="size-5" />
                                    </a>
                                @endcan

                                @can('delete', $ticket)
                                    <button class="hover:cursor-pointer text-ink-faint hover:text-error transition-colors" type="button" onclick="my_modal_{{ $ticket->id }}.showModal()" title="Excluir">
                                        <x-heroicon-o-trash class="size-5"/>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="md:hidden">
        @foreach($tickets as $ticket)
            <div class="card w-90 sm:w-110 bg-base-100 card-xs border border-base-content/10 mb-3">
                <div class="card-body">
                    <div class="justify-between flex">
                        <span class="badge {{ $ticket->status->color() }} text-[10px] p-2 font-medium">
                            {{ $ticket->status->label() }}
                        </span>
                        <span class="ml-auto text-ink-muted tabular-nums">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <h2 class="card-title">{{ $ticket->title }}</h2>

                    <p class="truncate text-ink-muted">{{ $ticket->description }}</p>

                    <div class="flex items-center justify-between gap-2 border-t border-base-content/10 pt-2 mt-1">
                        <span class="min-w-0 truncate text-ink-muted">{{ $ticket->category->description }}</span>

                        <div class="flex gap-2 shrink-0">
                            @can('view', $ticket)
                                <a href="{{ route('ticket.view', $ticket->id) }}" class="flex hover:underline text-ink-muted">
                                    <x-heroicon-o-eye class="size-4" />Visualizar
                                </a>
                            @endcan
                            @can('update', $ticket)
                                <a href="{{ route('ticket.edit', $ticket->id) }}" title="Editar" class="flex hover:underline text-ink-muted">
                                    <x-heroicon-o-pencil-square class="size-4" />Editar
                                </a>
                            @endcan

                            @can('delete', $ticket)
                                <button class="flex hover:cursor-pointer text-error hover:underline"
                                type="button" onclick="my_modal_{{ $ticket->id }}.showModal()" title="Excluir">
                                    <x-heroicon-o-trash class="size-4"/>Excluir
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h2 class="text-ink-muted">Nenhum chamado encontrado com esses filtros...</h2>
@endif

<div class="flex justify-center items-center my-5">
    {{ $tickets->links() }}
</div>

@foreach($tickets as $ticket)
    <x-modal
        id="my_modal_{{ $ticket->id }}"
        title="Excluir chamado"
        description="Tem certeza que deseja excluir o chamado?"
        href="{{ route('ticket.delete', $ticket) }}"
        confirm_button="Deletar"
        :delete="true"
    ></x-modal>
@endforeach

@endsection
