<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeoLocationService
{
    protected $apiUrl = 'http://ip-api.com/json';

    public function getLocation(string $ip): string
    {
        return Cache::remember("geo_location_{$ip}", 60 * 24, function () use ($ip) {
            try {
                $response = Http::get("{$this->apiUrl}/{$ip}");

                if ($response->ok()) {
                    $data = $response->json();
                    return $data['city'] . ', ' . $data['country'];
                }
            } catch (\Exception $e) {
                
            }

            return 'Unknown';
        });

    }
}
