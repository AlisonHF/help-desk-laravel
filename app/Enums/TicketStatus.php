<?php

    namespace App\Enums;

    enum TicketStatus: string
    {
        case Aberto = 'aberto';
        case EmAndamento = 'em_andamento';
        case AguardandoUsuario = 'aguardando_usuario';
        case Resolvido = 'resolvido';
        case Finalizado = 'finalizado';
        case Cancelado = 'cancelado';

        public function label(): string
        {
            return match ($this) {
                self::Aberto => 'Aberto',
                self::EmAndamento => 'Em andamento',
                self::AguardandoUsuario => 'Aguardando usuário',
                self::Resolvido => 'Resolvido',
                self::Finalizado => 'Finalizado',
                self::Cancelado => 'Cancelado'
            };
        }

        public function color(): string
        {
            return match ($this) {
                self::Aberto      => 'badge-accent',
                self::EmAndamento => 'badge-secondary',
                self::AguardandoUsuario => 'badge-neutral',
                self::Resolvido => 'badge-info',
                self::Finalizado  => 'badge-success',
                self::Cancelado => 'badge-error'
            };
        }
    }

?>