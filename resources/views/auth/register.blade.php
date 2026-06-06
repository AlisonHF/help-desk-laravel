@extends('Layouts.master')

@section('content')
<x-card-auth title="Cadastrar">
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Nome</legend>
        <label class="input input-bordered w-full">
            <input type="text" maxlength="100" />
        </label>
    </fieldset>
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">E-mail</legend>
        <label class="input input-bordered w-full">
            <input type="email" maxlength="100" />
        </label>
    </fieldset>
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Senha</legend>
        <label class="input input-bordered w-full">
            <input type="password" maxlength="32" />
        </label>
        <p class="label">A senha deve conter no minímo 6 caracteres</p>
    </fieldset>
    <fieldset class="fieldset w-full px-20">
        <legend class="fieldset-legend">Confirme a senha</legend>
        <label class="input input-bordered w-full">
            <input type="password" maxlength="32" />
        </label>
    </fieldset>

    <div class="text-center m-3">
        <span class="inline">Já tem uma conta? <a href="{{ Route('login') }}" class="text-blue-600">faça login</a></span>
    </div>

    <div class="flex mt-2 w-50">
        <button type="submit" class="btn bg-blue-600 text-white w-full">Cadastrar</button>
    </div>
</x-card-auth>
@endsection
