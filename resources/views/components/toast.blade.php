@if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-4 right-4 bg-success text-success-content px-6 py-3 rounded shadow-lg z-50"
    >
        <x-heroicon-o-check class="size-6 inline"/>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-4 right-4 bg-error text-error-content px-6 py-3 rounded shadow-lg z-50"
    >
        <x-heroicon-o-x-circle class="size-6 inline"/>
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-4 right-4 bg-info text-info-content px-6 py-3 rounded shadow-lg z-50"
    >
    <x-heroicon-o-question-mark-circle class="size-6 inline"/>
        {{ session('info') }}
    </div>
@endif