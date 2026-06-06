@extends('Layouts.master')

@section('content')
<x-card-auth title="Login">
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
    </fieldset>

    <div class="text-center m-3">
        <a href="#" class="text-blue-600 block">Esqueceu sua senha?</a>
        <span class="inline">Não tem uma conta? <a href="{{ Route('register') }}" class="text-blue-600">cadastre-se</a></span>
    </div>

    <div class="flex mt-2 w-50">
        <button type="submit" class="btn bg-blue-600 text-white w-full">Login</button>
    </div>
</x-card-auth>
@endsection
