@extends('Layouts.master')

@section('content')
<div class="w-full flex justify-center">
    <x-card-auth title="Recuperar senha">
        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col items-center w-full">
            <input name="token" class="hidden" value="{{ request()->route('token') }}"/>

            <fieldset class="fieldset w-full mb-3 hidden">
                <legend class="fieldset-legend">E-mail:</legend>
                <label class="input input-bordered w-full">
                    <input type="email" name="email" maxlength="100" value="{{ request()->email }}"/>
                </label>
                @error('email')
                    <p class="text-error text-sm my-2">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset w-full mb-3">
                <legend class="fieldset-legend">Digite a nova senha:</legend>
                <label class="input input-bordered w-full">
                    <input type="password" name="password" maxlength="32"/>
                </label>
                @error('password')
                    <p class="text-error text-sm my-2">{{ $message }}</p>
                @enderror
                <small class="label text-ink-muted">A senha deve conter no minímo 8 caracteres</small>
            </fieldset>

            <fieldset class="fieldset w-full mb-3">
                <legend class="fieldset-legend">Confirme a nova senha:</legend>
                <label class="input input-bordered w-full">
                    <input type="password" name="password_confirmation" maxlength="32"/>
                </label>
                @error('password_confirmation')
                    <p class="text-error text-sm my-2">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="flex w-50">
                <button type="submit" class="btn btn-primary w-full">Enviar</button>
            </div>
        </form>
    </x-card-auth>
</div>
@endsection
