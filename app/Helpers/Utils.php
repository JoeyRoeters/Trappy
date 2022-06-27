<?php

namespace App\Helpers;

use App\Models\Location;
use GuzzleHttp\Client;

class Utils
{
    public static function locationToAddress(Location $location): string
    {
        $client = new Client();

        $params = http_build_query([
            'latlng' => sprintf('%s,%s', $location->latitude, $location->longitude),
            'key' => env('GOOGLE_GEOCODING_API_KEY')
        ]);

        $request = $client->get('https://maps.googleapis.com/maps/api/geocode/json?' . $params);

        return json_decode($request->getBody()->getContents(), true)['results'][0]['formatted_address'];
    }
}
