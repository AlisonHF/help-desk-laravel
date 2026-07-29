@if (isset($namePage))
    <div>
        <h2 class="text-3xl my-5 mx-5 text-center">{{ $namePage }}</h2>
        <hr class="mx-10 my-4 border-t border-base-300" />
    </div>
@endif

@if(!empty($breadcrumbs))
    <div class="breadcrumbs text-sm flex justify-center mb-10">
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