@extends('layouts.master')

@section('content')
<div class="text-lg divider my-6">
        @if(isset($chamado))
            Editar chamado
        @else
            Abrir chamado
        @endif
    </h1>
</div>

<form method="POST" action="#" class="flex flex-col items-center m-5 rounded-2xl shadow-sm/50 p-5 w-200 h-120">
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Titulo</legend>
        <label class="input input-bordered w-full">
            <input name="titulo" type="text" value="{{ old('titulo') }}" maxlength="255" />
        </label>
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Descrição</legend>
        <textarea name="descricao" class="textarea w-full" rows="5" maxlength="2000">{{ old('descricao') }}</textarea>
    </fieldset>

    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Categoria</legend>
        <select name="categoria" class="select w-full"></select>
    </fieldset>

    <div class="flex mt-5 w-50">
        <button type="submit" class="btn bg-success text-white w-full">Enviar</button>
    </div>
</form>

@endsection