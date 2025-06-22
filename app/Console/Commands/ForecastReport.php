<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AccuWeatherService;

class ForecastReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast {cities?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the 5-day weather forecast for specified city/cities and displays the min, max and sky in a table: php artisan forecast {city/cities}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cities = $this->argument('cities');

        if (empty($cities)) {
            $city = $this->ask('Which city do you want the forecast for?');
            $cities = [$city];
        }

        $weather = new AccuWeatherService();

        foreach ($cities as $city) {
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

            $this->info("Forecast for: $city");

            $table = [];
            foreach ($forecasts as $day) {
                $table[] = [
                    date('l', strtotime($day['Date'])),
                    $day['Temperature']['Minimum']['Value'] . '°C',
                    $day['Temperature']['Maximum']['Value'] . '°C',
                    $day['Day']['IconPhrase']
                ];
            }

            $this->table(
                ['Day', 'Min Temp', 'Max Temp', 'Summary'],
                $table
            );
        }
    }
}