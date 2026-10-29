@extends('Layouts.master')

@section('content')

@if(!empty($notifications))
<div class="w-full">
    <div class="overflow-x-auto rounded-box border border-base-content/10 bg-base-100 hidden md:block mx-10">
        <table class="table table-fixed">
            <thead class="text-ink-muted">
                <tr>
                    <th class="w-1/12">Chamado</th>
                    <th class="w-2/12">Usuário</th>
                    <th class="w-8/12">Mensagem</th>
                    <th class="w-2/12">Enviada em</th>
                    <th class="w-2/12">Lida em</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection