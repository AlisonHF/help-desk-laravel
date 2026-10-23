@props(['title' => ''])

<div class="flex flex-col items-center rounded-box bg-base-100 border border-base-content/10 p-10 mt-10 mb-5 w-70 sm:w-90 sm:mb-0">
    <h1 class="text-center text-2xl font-semibold tracking-tight">{{ $title }}</h1>

    {{ $slot }}
</div>
