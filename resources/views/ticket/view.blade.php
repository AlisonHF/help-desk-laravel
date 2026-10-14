@extends('Layouts.master')

@section('content')
<div
    class="flex flex-col items-center rounded-2xl shadow-sm/50 overflow-hidden mx-10 p-5"
>

<h1 class="font-bold">{{ $ticket->title }}</h1>
<p class="mx-3 mt-3 mb-10">{{ $ticket->description }}</p>
<small class="w-full px-3 font-bold">
    {{ $ticket->user->name }} | 
    {{ $ticket->created_at->format('d/m/Y H:i') }}
    <span class="float-right ml-5">{{ $ticket->category->description }}</span>
</small>

@can('takeOnCall', $ticket)
<form class="bg-primary/20 w-full mt-10 rounded p-3">
    <fieldset class="fieldset w-full">
        <legend class="fieldset-legend">Resposta</legend>
        <textarea name="description" class="textarea w-full" rows="5" maxlength="2000" placeholder="Resposta..."></textarea>
        @error('')
            <span class="text-error text-sm"></span>
        @enderror
    </fieldset>

    <div class="mt-3">
        <button type="submit" class="btn btn-success w-50">Assumir chamado</button>
    </div>
</form>
@endcan
</div>

@endsection
