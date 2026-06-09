@extends('Layouts.master')

@section('content')
<x-card-auth title="Login">
    <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center m-5 w-full">
        @csrf

        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">E-mail</legend>
            <label class="input input-bordered w-full">
                <input name="email" type="email" value="{{ old('email') }}" maxlength="100" />
            </label>
        </fieldset>
        <fieldset class="fieldset w-full px-20">
            <legend class="fieldset-legend">Senha</legend>
            <label class="input input-bordered w-full">
                <input name="password" type="password" maxlength="32" />
            </label>
        </fieldset>

        @error('email')
            <p class="text-error text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="text-center m-3">
            <a href="#" class="text-blue-600 block">Esqueceu sua senha?</a>
            <span class="inline">Não tem uma conta? <a href="{{ Route('register') }}" class="text-blue-600">cadastre-se</a></span>
        </div>

        <div class="flex mt-2 w-50">
            <button type="submit" class="btn bg-blue-600 text-white w-full">Login</button>
        </div>
    </form>
</x-card-auth>
@endsection
