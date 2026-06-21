<?php

namespace App\Enums;

enum OrganizationRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Manager = 'manager';
    case SalesRep = 'sales_rep';
    case Viewer = 'viewer';

    public function level(): int
    {
        return match ($this) {
            self::Owner => 100,
            self::Admin => 80,
            self::Manager => 60,
            self::SalesRep => 40,
            self::Viewer => 20,
        };
    }
}
