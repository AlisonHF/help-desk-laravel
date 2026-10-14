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
    <span class="float-right">{{ $ticket->category->description }}</span>
</small>

</div>
@endsection
