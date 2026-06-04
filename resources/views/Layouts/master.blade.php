<!DOCTYPE html>
<html lang="pt-br" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen">
    <div class="navbar shadow-sm bg-blue-600 text-white">
        <a class="btn btn-ghost text-xl">Help-Desk</a>
    </div>
    <main class="flex flex-col items-center">
        @yield('content')
    </main>
</body>

</html>
