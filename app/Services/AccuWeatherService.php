<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AccuWeatherService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.acuweather.key');
    }

    public function getLocationKey(string $city): ?string
    {
        $response = Http::get("http://dataservice.accuweather.com/locations/v1/cities/search", [
            'apikey' => $this->apiKey,
            'q' => $city,
        ]);

        if ($response->successful() && !empty($response[0]['Key'])) {
            return $response[0]['Key'];
        }

        return null;
    }

    public function getFiveDayForecast(string $locationKey): ?array
    {
        $response = Http::get("http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$locationKey}?apikey={$this->apiKey}&metric=true");

        if ($response->successful() && isset($response['DailyForecasts'])) {
            return $response['DailyForecasts'];
        }

        return null;
    }
}
