@extends('Layouts.master')

@section('content')

@if(!empty($notifications))
<div class="w-full">
    <div class="w-full flex justify-end">
        <a href="{{ route('notification.readall') }}" type="button" class="btn btn-primary btn-outline mx-10 mb-2">
            Marcar todas como lidas
        </a>
    </div>

    <div class="overflow-x-auto rounded-box border border-base-content/10 bg-base-100 hidden md:block mx-10">
        <table class="table table-fixed">
            <thead class="text-ink-muted">
                <tr>
                    <th class="w-1/12">Chamado</th>
                    <th class="w-1/12">Usuário</th>
                    <th class="w-8/12">Mensagem</th>
                    <th class="w-2/12">Enviada em</th>
                    <th class="w-2/12">Lida em</th>
                    <th class="w-1/12">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr class="hover:bg-base-200 transition-colors">
                        <th class="tabular-nums font-medium text-ink-muted">{{ $notification->data['ticket_id'] }}</th>
                        <td class="text-ink-muted">{{ $notification->data['actor'] }}</td>
                        <td class="font-medium truncate" title="{{ $notification->data['message'] }}">{{ $notification->data['message'] }}</td>
                        <td class="text-ink-muted tabular-nums">{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-ink-muted tabular-nums">
                            {{ $notification->read_at ? $notification->read_at->format('d/m/Y H:i') : ''}}
                        </td>
                        @if(!$notification->read())
                        <td>
                            <form method="POST" action="{{ route('notification.read', $notification->id) }}">
                                @method('patch')
                                <button type="submit" class="btn btn-ghost btn-sm btn-circle" title="Marcar como lida">
                                    <x-heroicon-o-check-circle class="size-6"></x-heroicon-o-check-circle>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center items-center my-5">
        {{ $notifications->links() }}
    </div>
</div>
@endif

@endsection