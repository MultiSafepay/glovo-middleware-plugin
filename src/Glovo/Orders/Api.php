<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo\Orders;

use GlovoModels\Enum\OrderStatus;
use GlovoPlugin\Glovo\ApiRequest;

class Api
{
    use ApiRequest;

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function updateStatus(string $storeId, string $orderId, OrderStatus $status): array
    {
        $path = "webhook/stores/{$storeId}/orders/{$orderId}/status";

        return self::send('PUT', $path, ['status' => $status->value]);
    }

    /**
     * @param array<\GlovoModels\Order\Replacement> $replacements
     * @param array<string> $removedPurchases
     * @param array<\GlovoModels\Order\Product> $addedProducts
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function modifyOrderProducts(
        string $storeId,
        string $orderId,
        array $replacements,
        array $removedPurchases,
        array $addedProducts
    ): array
    {
        $path = "webhook/stores/{$storeId}/orders/{$orderId}/replace_products";

        $payload = [
            'replacements' => $replacements,
            'removed_purchases' => $removedPurchases,
            'added_products' => $addedProducts
        ];

        return self::send('POST', $path, $payload);
    }
}
