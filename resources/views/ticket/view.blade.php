@extends('Layouts.master')

@section('content')
<x-card-ticket-view>
    <h3 class="text-sm text-ink-muted float-left w-full mb-5">
        Protocolo: <span class="tabular-nums font-medium">{{ $ticket->id }}</span>
        <span class="badge {{ $ticket->status->color() }} text-[12px] p-2 font-medium float-right">
            {{ $ticket->status->label() }}
        </span>
    </h3>
    <h1 class="text-lg font-semibold tracking-tight">{{ $ticket->title }}</h1>
    <p class="mx-3 mt-3 mb-10">{{ $ticket->description }}</p>
    <small class="w-full px-3 text-ink-muted">
        {{ $ticket->user->name }} | 
        <span class="tabular-nums">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
        <span class="float-right ml-5">{{ $ticket->category->description }}</span>
    </small>
</x-card-ticket-view>

@if(!$chats->isEmpty())
    @foreach ($chats as $chat)
        @php($isStaff = in_array($chat->user->position->value, ['admin', 'tecnico'], true))
        <x-card-ticket-view
            class="p-3"
            :tone="$isStaff ? 'bg-primary/5 border-primary/20' : 'bg-base-100 border-base-content/10'">
            <h3 class="w-full text-left font-medium text-sm {{ $isStaff ? 'text-primary-dark' : 'text-ink-muted' }}">
                {{ $isStaff ? 'Técnico respondeu:' : 'Usuário respondeu:' }}
            </h3>

            <p class="mt-3 mb-10">{{ $chat->message }}</p>

            <small class="w-full text-ink-muted">
                {{ $chat->user->name }} | 
                <span class="tabular-nums">{{ $chat->created_at->format('d/m/Y H:i') }}</span>
            </small>
        </x-card-ticket-view>
    @endforeach
@endif

@if (!$chats->isEmpty() || auth()->user()->position->value != 'usuario')
    @can('userCanReply', $ticket)
    <x-card-ticket-view tone="bg-base-200 border-base-content/10">
        <form
            method="POST"
            action="{{ route('chat.store', $ticket->id) }}"
            class=" w-full"
        >
            @csrf
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">Resposta</legend>
                <textarea name="message" class="textarea w-full" rows="5" maxlength="2000" placeholder="Resposta..."></textarea>
                @error('message')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </fieldset>

            <div class="mt-3 flex gap-3">
                <button type="submit" class="btn btn-primary w-50 float-left">
                    {{ $chats->isEmpty() && auth()->user()->position->value != 'usuario' ? 'Assumir chamado' : 'Responder' }}
                </button>
                @can('resolveCall', $ticket)
                    <button type="button" onclick="my_modal_1.showModal()" class="btn btn-outline btn-primary w-50 float-left">
                        Resolver chamado
                    </button>
                @endcan
            </div>
        </form>
    </x-card-ticket-view>
    @endcan
@endif

<x-modal 
    id="my_modal_1"
    title="Resolver chamado"
    description="Tem certeza que deseja resolver o chamado?"
    href="{{ route('ticket.resolve', $ticket) }}"
    confirm_button="Resolver"
>
</x-modal>

@endsection
