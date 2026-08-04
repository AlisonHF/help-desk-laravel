@props(['title' => ''])

<div class="flex flex-col items-center rounded-2xl shadow-sm/50 p-10 mt-10 mb-5 w-70 sm:w-90 sm:mb-0">
    <h1 class="text-center text-2xl">{{ $title }}</h1>

    {{ $slot }}
</div>
