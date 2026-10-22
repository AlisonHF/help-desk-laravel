<?php

    namespace App\Enums;

    enum UserPositions: string
    {
        case Admin = 'admin';
        case Tecnico = 'tecnico';
        case Usuario = 'usuario';

        public function label(): string
        {
            return match ($this) {
                self::Admin => 'Admin',
                self::Tecnico => 'Técnico',
                self::Usuario => 'Usuário',
            };
        }
    }

?>