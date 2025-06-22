<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ForecastReport;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ForecastReport::class,
    ];

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:forecast-report Brisbane GoldCoast Maroochydore')
                 ->dailyAt('07:00');
    }

}