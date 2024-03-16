<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TasksEnum
{
    use EnumTrait;
    
    case callReason;
}
