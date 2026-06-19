@props(['title' => ''])

<div class="flex flex-col items-center my-20 mx-5 w-full rounded-2xl shadow-sm/50 p-5 max-w-md">
    <h1 class="text-center text-2xl mb-5">{{ $title }}</h1>

    {{ $slot }}
</div>
