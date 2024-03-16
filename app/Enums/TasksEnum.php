<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TasksEnum
{
    use EnumTrait;
    
    case call_reason;
    case call_actions;
    case satisfaction;
    case call_segments;
    case summary;
}
