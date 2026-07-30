@props([
    'icon',
    'title',
    'description',
    'href' => '#',
    'iconClass' => 'bg-blue-100 text-blue-500'
])

<div {{ $attributes->merge(['class' => 'card w-70 bg-base-100 card-sm shadow-sm']) }}>
    <div class="card-body">
        <div class="rounded w-min {{ $iconClass }}">
            <x-dynamic-component :component="$icon" class="size-8 m-1" />
        </div>

        <h2 class="card-title">{{ $title }}</h2>
        <p>{{ $description }}</p>
        <div class="card-actions mt-1">
            <a href="{{ $href }}" class="text-blue-700 hover:underline">Acessar →</a>
        </div>
    </div>
</div>