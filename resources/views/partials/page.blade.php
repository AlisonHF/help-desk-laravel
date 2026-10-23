@if (isset($namePage))
    <div>
        <h2 class="text-2xl font-semibold tracking-tight mt-3 mb-2 mx-5 text-center">{{ $namePage }}</h2>
    </div>
@endif

@if(!empty($breadcrumbs))
    <div class="breadcrumbs text-sm text-ink-muted flex justify-center mb-5">
        <ul>
        @foreach($breadcrumbs as $breadcrumb)
            <li><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['name'] }}</a></li>
        @endforeach
        </ul>
    </div>
@endif

<main class="flex flex-col items-center flex-1">
    <x-toast />
    @yield('content')
</main>