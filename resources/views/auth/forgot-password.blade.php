@extends('Layouts.master')

@section('content')
<div class="w-full flex justify-center">
    <x-card-auth title="Recuperar senha">
        <form method="POST" action="{{ route('password.email') }}"  class="flex flex-col items-center w-full">
            <fieldset class="fieldset w-full mb-3">
                <legend class="fieldset-legend">Digite seu e-mail:</legend>
                <label class="input input-bordered w-full">
                    <input type="email" name="email" maxlength="100"/>
                </label>
                @error('email')
                    <p class="text-error text-sm my-2 text-center">{{ $message }}</p>
                @enderror
                <p class="label text-center whitespace-normal text-ink-muted my-2">Não recebeu o e-mail? verifique o e-mail digitado e tente novamente após 1 minuto.</p>
            </fieldset>

            <div class="flex w-50">
                <button type="submit" class="btn btn-primary w-full">Enviar</button>
            </div>
        </form>
    </x-card-auth>
</div>
@endsection
