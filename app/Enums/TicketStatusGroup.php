<?php

namespace App\Enums;

use App\Enums\TicketStatus;

enum TicketStatusGroup: string {
    case Ativos = 'ativos';
    case Encerrados = 'encerrados';

    public function label()
    {
        return match ($this) {
            self::Ativos => 'Ativos',
            self::Encerrados => 'Encerrados',
        };
    }

    public function statuses(): array
    {
        return match ($this) {
            self::Ativos => [
                TicketStatus::Aberto->value,
                TicketStatus::AguardandoUsuario->value,
                TicketStatus::EmAndamento->value,
            ],
            self::Encerrados => [
                TicketStatus::Resolvido->value,
                TicketStatus::Finalizado->value,
                TicketStatus::Cancelado->value
            ]
        };
    }
}
