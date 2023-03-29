<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo\Orders;

use GlovoModels\Enum\OrderStatus;
use GlovoPlugin\Glovo\ApiRequest;
use Illuminate\Support\Collection;

class Api
{
    use ApiRequest;

    public static function updateStatus(string $storeId, string $orderId, OrderStatus $status): void
    {
        $path = "webhook/stores/{$storeId}/orders/{$orderId}/status";

        self::send('PUT', $path, ['status' => $status->value]);
    }

    /**
     * @param Collection<\GlovoModels\Order\Replacement> $replacements
     * @param array<string> $removedPurchases
     * @param Collection<\GlovoModels\Order\Product> $addedProducts
     */
    public static function modifyOrderProducts(
        string $storeId,
        string $orderId,
        Collection $replacements,
        array $removedPurchases,
        Collection $addedProducts
    ): void
    {
        $path = "webhook/stores/{$storeId}/orders/{$orderId}/replace_products";

        $payload = [
            'replacements' => $replacements,
            'removed_purchases' => $removedPurchases,
            'added_products' => $addedProducts
        ];

        self::send('POST', $path, $payload);
    }
}
