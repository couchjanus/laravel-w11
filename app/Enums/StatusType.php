<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusType extends Enum
{
    const Draft = 0;
    const Scheduled = 1;
    const Published = 2;
    const Archived = 3;
}
