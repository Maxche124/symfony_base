<?php

namespace App\Entity\Enum;

enum OrderStatus: string
{
    case PREPARATION = 'en préparation';
    case SHIPPED = 'expédiée';
    case DELIVERED = 'livrée';
    case CANCELED = 'annulée';
}
