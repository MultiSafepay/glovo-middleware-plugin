<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo\Content;

use GlovoModels\Menu\Product as Model;
use GlovoModels\Menu\Attribute as Attribute;
use GlovoPlugin\Glovo\ApiRequest;

class Item
{
    use ApiRequest;

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function modifyProducts(string $storeId, string $productId, Model $product): array
    {
        $path = "webhook/stores/{$storeId}/products/$productId";

        return self::send('PATCH', $path, $product->toArray());
    }


    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function modifyAttributes(string $storeId, string $attributeId, Attribute $attribute): array
    {
        $path = "webhook/stores/{$storeId}/attributes/$attributeId";

        return self::send('PATCH', $path, $attribute->toArray());
    }

    /**
     * @param array<\GlovoModels\Order\Product> $products
     * @param array<\GlovoModels\Order\Attribute> $attributes
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function bulkUpdateItems(string $storeId, array $products, array $attributes): array
    {
        $path = "webhook/stores/{$storeId}/menu/updates";

        $payload = [
            'products' => $products,
            'attributes' => $attributes,
        ];

        /** @phpstan-ignore-next-line */
        return self::send('POST', $path, $payload);
    }

    /**
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function verifyBulkUpdateItems(string $storeId, string $transactionId): array
    {
        $path = "webhook/stores/{$storeId}/menu/updates/$transactionId";

        return self::send('GET', $path);
    }
}
