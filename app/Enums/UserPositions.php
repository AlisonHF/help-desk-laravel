<?php

    namespace App\Enums;

    enum UserPositions: string
    {
        case Admin = 'admin';
        case Technician = 'technician';
        case User = 'user';

        public function label(): string
        {
            return match ($this) {
                self::Admin => 'Admin',
                self::Technician => 'Técnico',
                self::User => 'Usuário',
            };
        }
    }

?>