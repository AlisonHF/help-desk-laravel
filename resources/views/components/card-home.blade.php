@props([
    'icon',
    'title',
    'description',
    'href' => '#',
    'iconClass' => 'bg-primary/10 text-primary'
])

<div {{ $attributes->merge(['class' => 'card w-70 bg-base-100 card-sm shadow-sm']) }}>
    <div class="card-body">
        <div class="rounded w-min {{ $iconClass }}">
            <x-dynamic-component :component="$icon" class="size-8 m-1" />
        </div>

        <h2 class="card-title">{{ $title }}</h2>
        <p>{{ $description }}</p>
        <div class="card-actions mt-1">
            <a href="{{ $href }}" class="link link-primary">Acessar →</a>
        </div>
    </div>
</div>