<!DOCTYPE html>
<html lang="pt-br" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">
    <div class="navbar shadow-sm bg-neutral text-white">
        <a href="{{ route('home') }}" class="btn btn-ghost text-xl">Help-Desk</a>
    </div>

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
        @yield('content')
    </main>
</body>

</html>
