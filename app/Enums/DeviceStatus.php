<?php

namespace App\Enums;

enum DeviceStatus: string
{
    case Available = 'AV';
    case Assigned = 'AS';
    case Locked = 'LC';
    case Disposed = 'DS';
    case Lost = 'LS';
    case Stolen = 'ST';
    case Damaged = 'DM';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Disponible',
            self::Assigned => 'Asignado',
            self::Locked => 'Bloqueado',
            self::Disposed => 'Baja/Devuelto',
            self::Lost => 'Extraviado',
            self::Stolen => 'Robado',
            self::Damaged => 'Dañado'
        };
    }
}
