<?php

namespace App\Enums;

/**
 * Class OrderType
 *
 * @method static string all()
 * @method static string|null nameFor($value)
 * @method static array toArray()
 * @method static array forApi()
 * @method static string slug(int $value)
 */
class OrderType extends Base
{
    public const SERVICE  = 0;
    public const PLACE    = 1;
}
