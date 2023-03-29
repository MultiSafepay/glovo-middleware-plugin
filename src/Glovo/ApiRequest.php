<?php

declare(strict_types=1);

namespace GlovoPlugin\Glovo;

use Exception;
use Illuminate\Support\Facades\Http;

trait ApiRequest
{
    /**
     * @param string $method
     * @param string $path
     * @param null|array<string, array<string>>|array<string, string>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public static function send(string $method, string $path, null|array $data = null): string|array
    {
        $url = config('glovo.glovo_api.url').$path;
        $response = Http::withHeaders(['Authorization' => TokenManager::getToken()])
            ->$method($url, $data);

        if ($response->successful()) {
            return $response->json();
        }

        $message = "Error requesting glovo, method: $method, url: $url, data: ".print_r($data, true);
        $message .= PHP_EOL.' Response: '.$response->json();

        throw new Exception($message);
    }
}
