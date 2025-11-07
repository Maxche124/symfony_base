<?php

namespace App\Entity\Enum;

enum PokeBallStatus: string
{
    case AVAILABLE = 'disponible';
    case OUT_OF_STOCK = 'en rupture';
    case PRE_ORDER = 'en précommande';
}
