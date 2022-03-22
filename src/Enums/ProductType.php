<?php

namespace App\Enums;

use App\Exceptions\UnknownProductTypeException;
use App\Logic\AgingItemLogic;
use App\Logic\BackstageItemLogic;
use App\Logic\ConjuredItemLogic;
use App\Logic\LegendaryItemLogic;
use App\Logic\RegularItemLogic;

class ProductType
{
    const REGULAR   = 'regular';
    const AGING     = 'aging';
    const LEGENDARY = 'legendary';
    const BACKSTAGE = 'backstage';
    const CONJURED  = 'conjured';

    /**
     * Retrieve the next day logic class for the given type
     *
     * @param  string  $type  Item type
     *
     * @return string|null Fully qualifies class string
     */
    public static function getNextDayLogicClass(string $type): ?string
    {
        $map = [
            self::REGULAR => RegularItemLogic::class,
            self::AGING => AgingItemLogic::class,
            self::LEGENDARY => LegendaryItemLogic::class,
            self::BACKSTAGE => BackstageItemLogic::class,
            self::CONJURED => ConjuredItemLogic::class,
        ];

        if (!isset($map[$type])) {
            throw new UnknownProductTypeException(sprintf('Unknown Item Type of "%s"', $type));
        }

        return $map[$type];
    }
}
