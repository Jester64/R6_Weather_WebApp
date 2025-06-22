<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AccuWeatherService;
use Illuminate\Support\Facades\Storage;

class GenerateDailyForecastReport extends Command
{
    protected $signature = 'report:daily-weather';
    protected $description = 'Generates a daily weather report for Brisbane, Gold Coast, and Sunshine Coast/Maroochydore';

    Public function handle(){

        $weather = new AccuWeatherService();
        $cities = ['Brisbane', 'Gold Coast', 'Maroochydore'];

        foreach($cities as $city) {
            $locationKey = $weather->getLocationKey($city);

            if (!$locationKey) {
                $this->error("Could not find location key for: $city");
                continue;
            }

            $forecasts = $weather->getFiveDayForecast($locationKey);

            if (!$forecasts) {
                $this->error("Could not fetch forecast for: $city");
                continue;
            }

            $today = $forecasts[0];
            $day = date('l', strtotime($today['Date']));
            $min = $today['Temperature']['Minimum']['Value'];
            $max = $today['Temperature']['Maximum']['Value'];
            $summary = $today['Day']['IconPhrase'];

            $reportLines[] = " $city";
            $reportLines[] = " - Day: $day";
            $reportLines[] = " - Min Temp: $min";
            $reportLines[] = " - Max Temp: $max";
            $reportLines[] = " - Summary: $summary";
            $reportLines[] = "";
        }

        $reportText = implode(PHP_EOL, $reportLines);
        $filename = 'weather_report_' . date('Y-m-d') . '.txt';

        // Save to storage/app/reports/
        Storage::put("reports/$filename", $reportText);

        $this->info("Weather report saved as: storage/app/reports/$filename");
    }
}