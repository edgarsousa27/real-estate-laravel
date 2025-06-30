<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenCageService
{
    protected $api = 'https://api.opencagedata.com/geocode/v1/json';

    public function forwardGeoLocation(string $address)
    {
        $response = Http::get($this->api, [
            'key' => config('services.opencage.key'),
            'q' => $address,
            'limit' => 1,
            'language' => 'pt',
            'no_annotations' => 1
        ]);

        if (!empty($response['results'][0]['geometry'])) {
            return [
                'latitude' => $response['results'][0]['geometry']['lat'],
                'longitude' => $response['results'][0]['geometry']['lng'],
            ];
        }

        return null;
    }
}
