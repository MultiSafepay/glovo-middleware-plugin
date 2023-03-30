<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo\Content;

use GlovoModels\Menu\Menu as Model;
use GlovoPlugin\Glovo\ApiRequest;

class Menu
{
    use ApiRequest;

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function uploadMenu(string $storeId, string $menuUrl): array
    {
        $path = "webhook/stores/{$storeId}/menu";

        return self::send('POST', $path, ['menuUrl' => $menuUrl]);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function verifyUploadMenu(string $storeId, string $transactionId): array
    {
        $path = "webhook/stores/{$storeId}/menu/$transactionId";

        return self::send('GET', $path);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function validateMenu(string $storeId, Model $menu): array
    {
        $path = "webhook/stores/{$storeId}/menu";

        return self::send('POST', $path, $menu->toArray());
    }
}
