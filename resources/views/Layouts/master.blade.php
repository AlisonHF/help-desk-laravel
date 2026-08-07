<!DOCTYPE html>
<html lang="pt-br" data-theme="lemonade">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">
    @auth
        <!-- Navbar -->
        <nav class="navbar w-full bg-base-300 border-b border-base-content/10 sticky top-0 z-30">
            <div class="navbar-start">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost drawer-button">
                    <x-heroicon-o-bars-3 class="my-1.5 inline-block size-5" />
                </label>
                <div class="text-xl">
                    <a href="{{ route('home') }}" class="px-4">
                        Help<span class="text-primary font-medium tracking-widest">Desk</span>
                    </a>
                </div>
            </div>

            <div class="navbar-end">
                <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                    <div class="avatar avatar-placeholder cursor-pointer">
                        <div tabindex="0" role="button" class="bg-primary/70 w-8 rounded-full m-1">
                            <span class="text-xs">AF</span>
                        </div>
                        <ul tabindex="-1" class="dropdown-content menu bg-base-200 rounded-box z-1 w-30 p-2 shadown-sm">
                            <form method="POST" action="{{ route('logout') }}" class="">
                                <li class="">                                    
                                    @csrf
                                    <button type="submit" class="flex flex-row">
                                        <x-heroicon-o-arrow-left-end-on-rectangle class="size-4" />
                                        Sair
                                    </button>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="drawer lg:drawer-open flex-1">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle inline" />
            <div class="drawer-content">
                @include('partials.page')
            </div>

            <div class="drawer-side is-drawer-close:overflow-visible">
                <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="flex min-h-full flex-col items-start bg-base-300 is-drawer-close:w-14 is-drawer-open:w-64">
                    <!-- Sidebar content here -->
                    <ul class="menu w-full grow">
                        <!-- List item -->
                        <li>
                            <a href="{{ route('home') }}">
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Página inicial">
                                    <x-heroicon-o-home class="my-1.5 inline-block size-5" />
                                    <span class="is-drawer-close:hidden">Página inicial</span>
                                </button>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('ticket.new') }}">
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Novo chamado">
                                    <x-heroicon-o-plus-circle class="my-1.5 inline-block size-5" />
                                    <span class="is-drawer-close:hidden">Novo chamado</span>
                                </button>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Chamados em aberto">
                                    <x-heroicon-o-chat-bubble-bottom-center class="my-1.5 inline-block size-5" />
                                    <span class="is-drawer-close:hidden">Chamados em aberto</span>
                                </button>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('ticket.list') }}">
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Histórico de chamados">
                                    <x-heroicon-o-archive-box class="my-1.5 inline-block size-5" />
                                    <span class="is-drawer-close:hidden">Histórico de chamados</span>
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <nav class="navbar w-full bg-base-300 shadow-sm">
            <div class="text-xl">
                <a href="{{ route('home') }}" class="px-4">
                    Help<span class="text-primary font-medium tracking-widest">Desk</span>
                </a>
            </div>
        </nav>
        @include('partials.page')
    @endauth
</body>

</html>
