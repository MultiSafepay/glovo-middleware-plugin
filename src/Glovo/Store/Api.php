<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo\Store;

use GlovoPlugin\Glovo\ApiRequest;
use GlovoModels\Store\Schedule;
use Illuminate\Support\Carbon;

class Api
{
    use ApiRequest;

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function schedule(string $storeId): array
    {
        $path = "webhook/stores/{$storeId}/schedule";

        return self::send('GET', $path);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function closeTemporaly(string $storeId, Carbon $until): array
    {
        $path = "webhook/stores/{$storeId}/closing";

        return self::send('PUT', $path, ['until' => $until->toW3cString()]);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function activeTemporalyClosing(string $storeId): array
    {
        $path = "webhook/stores/{$storeId}/closing";

        return self::send('GET', $path);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function removeTemporalyClosing(string $storeId): array
    {
        $path = "webhook/stores/{$storeId}/closing";

        return self::send('DELETE', $path);
    }
}
