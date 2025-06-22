<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccuWeatherService;

class ForecastController extends Controller
{
    public function getForecast(Request $request)
    {
        $city = $request->query('city');
        if (!$city) {
            return response()->json(['error' => 'City parameter is required'], 400);
        }

        $weather = new AccuWeatherService();
        $locationKey = $weather->getLocationKey($city);

        if (!$locationKey) {
            return response()->json(['error' => 'Could not find location key for: ' . $city], 404);
        }

        $forecasts = $weather->getFiveDayForecast($locationKey);

        if (!$forecasts) {
            return response()->json(['error' => 'Could not fetch forecast for: ' . $city], 500);
        }

        return response()->json(
            array_map(function ($day) {
                return [
                    'day' => date('l', strtotime($day['Date'])),
                    'min_temp' => $day['Temperature']['Minimum']['Value'],
                    'max_temp' => $day['Temperature']['Maximum']['Value'],
                    'summary' => $day['Day']['IconPhrase']
                ];
            }, $forecasts)
        );
    }
}