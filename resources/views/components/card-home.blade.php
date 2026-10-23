@props([
    'icon',
    'title',
    'description',
    'href' => '#',
    'iconClass' => 'bg-primary/10 text-primary-dark'
])

<div {{ $attributes->merge(['class' => 'card w-70 bg-base-100 card-sm border border-base-content/10']) }}>
    <div class="card-body">
        <div class="rounded w-min {{ $iconClass }}">
            <x-dynamic-component :component="$icon" class="size-8 m-1" />
        </div>

        <h2 class="card-title text-base">{{ $title }}</h2>
        <p class="text-ink-muted">{{ $description }}</p>
        <div class="card-actions mt-1">
            <a href="{{ $href }}" class="link link-primary">Acessar →</a>
        </div>
    </div>
</div>