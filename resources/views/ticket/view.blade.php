@extends('Layouts.master')

@section('content')
<x-card-ticket-view>
    <h3 class="text-sm font-bold float-left w-full mb-5">
        Protocolo: {{ $ticket->id }}
        <span class="badge {{ $ticket->status->color() }} rounded-2xl text-[12px] p-2 float-right">
            <b>{{ $ticket->status->label() }}</b>
        </span>
    </h3>
    <h1 class="font-bold">{{ $ticket->title }}</h1>
    <p class="mx-3 mt-3 mb-10">{{ $ticket->description }}</p>
    <small class="w-full px-3 font-bold">
        {{ $ticket->user->name }} | 
        {{ $ticket->created_at->format('d/m/Y H:i') }}
        <span class="float-right ml-5">{{ $ticket->category->description }}</span>
    </small>
</x-card-ticket-view>

@if(!$chats->isEmpty())
    @foreach ($chats as $chat)
        <x-card-ticket-view
            class="{{ ($chat->user->position->value === 'admin' || $chat->user->position->value === 'technician' ) ? 'bg-info/20' : '' }}
            p-3">
            <h3 class="w-full text-left font-bold text-sm">{{ ($chat->user->position->value === 'admin' || $chat->user->position->value === 'technician' ) ? 
                'Técnico respondeu:' : 'Usuário respondeu:' }}</h3>

            <p class="mt-3 mb-10">{{ $chat->message }}</p>

            <small class="w-full font-bold">
                {{ $chat->user->name }} | 
                {{ $chat->created_at->format('d/m/Y H:i') }}
            </small>
        </x-card-ticket-view>
    @endforeach
@endif

@if (!$chats->isEmpty() || auth()->user()->position->value != 'user')
    @can('userCanReply', $ticket)
    <x-card-ticket-view class="bg-primary/20">
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
                <button type="submit" class="btn btn-success w-50 float-left">
                    {{ $chats->isEmpty() && auth()->user()->position->value != 'user' ? 'Assumir chamado' : 'Responder' }}
                </button>
                <button type="button" onclick="my_modal_1.showModal()" class="btn btn-info w-50 float-left">
                    Finalizar chamado
                </button>
            </div>
        </form>
    </x-card-ticket-view>
    @endcan
@endif
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hello!</h3>
        <p class="py-4">Press ESC key or click outside to close</p>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endsection
