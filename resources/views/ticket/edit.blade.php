@extends('Layouts.master')

@section('content')
<form method="POST" action="{{ isset($ticket) ? route('ticket.update', $ticket) : route('ticket.store') }}" class="flex flex-col items-center rounded-2xl shadow-sm/50 p-5 w-200 h-120">
    @csrf
    
    @if (isset($ticket))
        @method('PATCH')
    @endif

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Titulo</legend>
        <label class="input input-bordered w-full">
            <input 
                name="title"
                type="text"
                value="{{ isset($ticket) ? $ticket->title : old('title') }}"
                maxlength="255"
                />
        </label>
        @error('title')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Descrição</legend>
        <textarea name="description" class="textarea w-full" rows="5" maxlength="2000">{{ 
            isset($ticket) ? $ticket->description : old('description')
         }}
        </textarea>
        @error('description')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Categoria</legend>
        <select name="category_id" class="select w-full">
            <option value="">Selecione a categoria</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category['id'] }}"
                    @if (isset($ticket))
                        @if ($category['id'] == $ticket->category_id)
                            selected
                        @endif
                    @endif
                >{{ $category['description'] }}</option>
            @endforeach
        </select>
        @error('category')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <div class="flex mt-5 w-50">
        <button type="submit" class="btn bg-success-content text-white w-full">Enviar</button>
    </div>
</form>

@endsection