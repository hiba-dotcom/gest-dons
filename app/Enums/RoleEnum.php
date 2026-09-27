<?php

namespace App\Enums;

enum RoleEnum: string {
    case adherant = 'adherant';
    case admin = 'admin';
    case président = 'président';
    case imam = 'imam';
}
