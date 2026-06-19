@extends('Layouts.master')

@section('content')
<x-card-auth title="Cadastrar">
    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center m-5 w-full">
        @csrf
        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">Nome</legend>
            <label class="input input-bordered w-full">
                <input name="name" type="text" maxlength="100" />
            </label>
            @error('name')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">E-mail</legend>
            <label class="input input-bordered w-full">
                <input name="email" type="email" maxlength="100" />
            </label>
            @error('email')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">Senha</legend>
            <label class="input input-bordered w-full">
                <input name="password" type="password" maxlength="32" />
            </label>
            <p class="label">A senha deve conter no minímo 8 caracteres</p>
            @error('password')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">Confirme a senha</legend>
            <label class="input input-bordered w-full">
                <input name="password_confirmation" type="password" maxlength="32" />
            </label>
            @error('password_confirmation')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>

        <div class="text-center m-3">
            <span class="inline">Já tem uma conta? <a href="{{ Route('login') }}" class="text-blue-600 hover:underline">faça login</a></span>
        </div>

        <div class="flex mt-2 w-50">
            <button type="submit" class="btn bg-success-content text-white w-full">Cadastrar</button>
        </div>
    </form>
</x-card-auth>
@endsection
