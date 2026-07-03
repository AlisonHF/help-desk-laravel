<?php

    namespace App\Enums;

    enum TicketStatus: string
    {
        case Aberto = 'aberto';
        case EmAndamento = 'em_andamento';
        case Finalizado = 'finalizado';

        public function label(): string
        {
            return match ($this) {
                self::Aberto => 'Aberto',
                self::EmAndamento => 'Em andamento',
                self::Finalizado => 'Finalizado',
            };
        }

        public function color(): string
        {
            return match ($this) {
                self::Aberto      => 'badge-accent',
                self::EmAndamento => 'badge-info',
                self::Finalizado  => 'badge-success'
            };
        }
    }

?>