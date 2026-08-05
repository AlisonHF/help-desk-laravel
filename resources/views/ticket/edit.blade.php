@extends('Layouts.master')

@section('content')
<form
    method="POST"
    action="{{ isset($ticket) ? route('ticket.update', $ticket) : route('ticket.store') }}"
    class="flex flex-col items-center rounded-2xl shadow-sm/50 overflow-hidden sm:w-150"
>
    @csrf

    @if (isset($ticket))
        @method('PATCH')
    @endif

    <div class="flex flex-col items-center w-full px-10 py-3 sm:px-20">
        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Titulo</legend>
            <label class="input input-bordered w-full">
                <input
                    name="title"
                    type="text"
                    value="{{ isset($ticket) ? $ticket->title : old('title') }}"
                    maxlength="255"
                    placeholder="Impressora fiscal não conecta"
                    />
            </label>

            @error('title')
                <span class="text-error text-sm">{{ $message }}</span>
            @else
                <small class="text-xs">Resuma o problema em uma frase</small>
            @enderror
        </fieldset>

        <fieldset class="fieldset w-full">
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
            @error('category_id')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </fieldset>

        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Descrição</legend>
            <textarea name="description" class="textarea w-full" rows="5" maxlength="2000" placeholder="Descreva o que aconteceu, quando começou e o que você já tentou.">{{
                isset($ticket) ? $ticket->description : old('description')
             }}</textarea>
            @error('description')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </fieldset>
    </div>

    <div class="flex justify-end gap-2 w-full border-t border-base-300 bg-base-200 px-10 py-4 sm:px-20">
        <button class="btn btn-error w-25">Cancelar</button>
        <button type="submit" class="btn btn-success w-50">Enviar</button>
    </div>
</form>

@endsection