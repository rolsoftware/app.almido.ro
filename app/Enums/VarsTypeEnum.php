<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static String()
 * @method static static Interger()
 * @method static static Date()
 * @method static static Array()
 * @method static static Email()
 */
final class VarsTypeEnum extends Enum
{
    const String      = 1;
    const Interger    = 2;
    const Date        = 3;
    const Array       = 4;
    const Email       = 5;
}
