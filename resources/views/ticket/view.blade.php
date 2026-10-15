@extends('Layouts.master')

@section('content')
<x-card-ticket-view>

    <h1 class="font-bold">{{ $ticket->title }}</h1>
    <p class="mx-3 mt-3 mb-10">{{ $ticket->description }}</p>
    <small class="w-full px-3 font-bold">
        {{ $ticket->user->name }} | 
        {{ $ticket->created_at->format('d/m/Y H:i') }}
        <span class="float-right ml-5">{{ $ticket->category->description }}</span>
    </small>
</x-card-ticket-view>

@if(!empty($chats))

    @foreach ($chats as $chat)
        <x-card-ticket-view 
            class="{{ ($chat->user->position->value === 'admin' || $chat->user->position->value === 'technician' ) ? 'bg-info/20' : '' }}">
            <p class="mx-3 mt-3 mb-10">{{ $chat->message }}</p>

            <small class="w-full px-3 font-bold">
                {{ $chat->user->name }} | 
                {{ $chat->created_at->format('d/m/Y H:i') }}
            </small>
        </x-card-ticket-view>
        
    @endforeach

@endif

@can('takeOnCall', $ticket)
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

    <div class="mt-3">
        <button type="submit" class="btn btn-success w-50">Assumir chamado</button>
    </div>
</form>
</x-card-ticket-view>
@endcan

@endsection
