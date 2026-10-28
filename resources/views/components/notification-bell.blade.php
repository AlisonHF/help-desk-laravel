<div class="dropdown dropdown-end">
    <button tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <x-heroicon-o-bell class="size-5.5" />
            @if($total > 0)
                <span class="indicator-item badge badge-primary badge-xs">{{ $total }}</span>
            @endif
        </div>
    </button>

    <ul tabindex="-1" class="dropdown-content menu bg-base-100 border border-base-content/10 rounded-box shadow-lg z-10 w-80 p-2">
        @forelse($notifications as $notification)
            <li>
                <a href="{{ route('notification.read', $notification->id) }}">
                    <span>{{ $notification->data['message'] }}</span>
                    <span class="text-xs text-ink-muted">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            </li>
        @empty
            <li class="p-3 text-sm text-ink-muted">Nenhuma notificação</li>
        @endforelse
    </ul>
</div>