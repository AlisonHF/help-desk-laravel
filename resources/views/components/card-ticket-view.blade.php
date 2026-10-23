@props(['tone' => 'bg-base-100 border-base-content/10'])

<div {{ $attributes->class([
    'flex flex-col items-center rounded-box border overflow-hidden mx-10 p-5 lg:w-250 mb-5',
    $tone,
]) }}>
    {{ $slot }}
</div>
