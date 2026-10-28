<div class="dropdown dropdown-end">
    <button tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <x-heroicon-o-bell class="size-5.5" />
            @if($total > 0)
            <span class="indicator-item badge badge-primary badge-xs">{{ $total }}</span>
            @endif
        </div>
    </button>

    <div
        tabindex="-1"
        class="dropdown-content menu bg-base-100 border border-base-content/10 rounded-box shadow-lg z-10 w-100 p-0">

        <div class="bg-base-200 border-b border-base-300 p-2">
            <span class="font-semibold tracking-tight text-sm">Notificações</span>
            <a
                href="{{ route('notification.readall') }}"
                class="text-primary float-end hover:link hover:text-primary-dark">
                Marcar todas como lidas
            </a>
        </div>

        <ul class="menu p-3 gap-2 w-full">
            @forelse($notifications as $notification)
                <li>
                    <div class="flex">
                        <a href="{{ route('notification.read', $notification->id) }}">
                            <div class="grid grid-flow-col grid-rows-1 grid-cols-[auto_1fr]">
                                <div class="flex items-center p-2 mr-2 bg-primary/20 rounded">
                                    <x-heroicon-o-megaphone class="size-5 text-primary-dark" />
                                </div>
                                <div class="">
                                    <span class="block">{{ $notification->data['message'] }}</span>
                                    <span class="text-xs text-ink-muted block">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            @empty
                <li class="p-3 text-sm text-ink-muted text-center">Nenhuma notificação</li>
            @endforelse
        </ul>

        <div class="bg-base-200 border-t border-base-300 p-2">
            <a href="#" class="block text-center text-primary hover:link hover:text-primary-dark">Ver todas</a>
        </div>

    </div>
</div>