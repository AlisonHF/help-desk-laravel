@extends('Layouts.master')

@section('content')
<div class="text-lg divider my-6">
        @if(isset($chamado))
            Editar chamado
        @else
            Abrir chamado
        @endif
    </h1>
</div>

<form method="POST" action="{{ route('ticket.store') }}" class="flex flex-col items-center m-5 rounded-2xl shadow-sm/50 p-5 w-200 h-120">
    @csrf
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Titulo</legend>
        <label class="input input-bordered w-full">
            <input name="title" type="text" value="{{ old('title') }}" maxlength="255" />
        </label>
        @error('title')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Descrição</legend>
        <textarea name="description" class="textarea w-full" rows="5" maxlength="2000">{{ old('description') }}</textarea>
        @error('description')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Categoria</legend>
        <select name="category_id" class="select w-full">
            <option value="">Selecione a categoria</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['description'] }}</option>
            @endforeach
        </select>
        @error('category')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </fieldset>

    <div class="flex mt-5 w-50">
        <button type="submit" class="btn bg-success text-white w-full">Enviar</button>
    </div>
</form>

@endsection