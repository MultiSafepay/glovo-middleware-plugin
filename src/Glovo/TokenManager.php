<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo;

class TokenManager
{
    private static string $token;

    public static function getToken(): string
    {
        if (empty(self::$token)) {
            self::$token = config('glovo.glovo_api.token');
        }

        return self::$token;
    }
}
