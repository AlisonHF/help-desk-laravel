@extends('Layouts.master')

@section('content')
<x-card-auth title="Cadastrar">
    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center w-full">
        @csrf
        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Nome</legend>
            <label class="input input-bordered w-full">
                <input name="name" type="text" maxlength="100" />
            </label>
            @error('name')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">E-mail</legend>
            <label class="input input-bordered w-full">
                <input name="email" type="email" maxlength="100" />
            </label>
            @error('email')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Senha</legend>
            <label class="input input-bordered w-full">
                <input name="password" type="password" maxlength="32" />
            </label>
            <small class="label">A senha deve conter no minímo 8 caracteres</small>
            @error('password')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset w-full ">
            <legend class="fieldset-legend">Confirme a senha</legend>
            <label class="input input-bordered w-full">
                <input name="password_confirmation" type="password" maxlength="32" />
            </label>
            @error('password_confirmation')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>

        <div class="text-center my-2">
            <span class="inline">Já tem uma conta? <a href="{{ Route('login') }}" class="link link-primary">faça login</a></span>
        </div>

        <div class="flex w-50">
            <button type="submit" class="btn btn-success w-full">Cadastrar</button>
        </div>
    </form>
</x-card-auth>
@endsection
