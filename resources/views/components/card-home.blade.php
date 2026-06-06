<div {{ $attributes->merge(['class' => 'card w-50 shadow-sm']) }}>
    <div class="flex flex-row justify-center items-center p-4">
        {{ $slot }}
    </div>
</div>