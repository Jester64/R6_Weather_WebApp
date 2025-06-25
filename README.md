<h1/>Weather Forecast Web App (Laravel + React)</h1>

This application displays a 5-day weather forecast for selected Australian cities using the AccuWeather API. It’s built with a Laravel backend and a React + Vite frontend.


<h2/>Setup Instructions</h2>

<h3/>1. Install PHP, Laravel, and Composer</h3>

go to https://laravel.com/docs/12.x/installation#installing-php and follow the install steps

OR

Make sure PHP 8.1+ is installed. You can download it from php.net or install it via:

    Windows: XAMPP

    macOS: brew install php

    Linux: sudo apt install php

<h3/>2. Clone the repo and install Laravel dependencies:</h3>

composer:

    composer install    

<h3/>3. Set your API Key</h3>

Open .env and add your AccuWeather API key:

    ACCUWEATHER_API_KEY=your_api_key_here

<h3/>4. Start the dev server</h3>

Open cmd and go to File project location. Use the following command to run both the Laravel server and frontend together:

    composer run dev

This starts:

    Laravel backend at: http://127.0.0.1:8000/

    Vite dev server (React) at: http://localhost:5173/ (used under the hood)

<h3/>5. Access the App</h3>

Visit:

http://127.0.0.1:8000/

<h3/>6. Forecast Artisan Command</h3>

use php artisan forecast {cities?*} to view forecast data in comand prompt:

    php artisan forecast Brisbane

    OR

    php artisan forecast Brisbane ColdCoast Maroochydore

 <h3/>7. How To Use the Website</h3>

Use the dropdown to select a city and view the forecast.

<h2/>Design Choices</h2>

<h3/>React + Vite Frontend:</h3> 
React handles the dynamic UI, using useEffect and useState to manage city selection and loading state.

<h3/>Weather Info Display:</h3>
Shows one city's weather data at a time for readability. Added Weather conditions to display to show more relevent data to user.

<h3/>Laravel API:</h3>
An endpoint at /api/forecast?city=CityName fetches and returns clean JSON data formatted for the frontend.

<h3/>Fallback States:</h3>
Includes UI handling for loading, errors, and no data conditions.

<h3/>AccuWeather API:</h3> 
Offers accurate 5-day forecasts, accessed via a custom Laravel AccuWeatherService class, and is free to use.

<h3/>Daily Report:</h3> 
Task Brief intro mentions daily generated report, but no details and expectations in Success Critiera:

Created app\Console\Commands\GenerateDailyForecastReport.php to gather forecast data that day from Brisbane, Gold Coast, and Sunshine Coast that genrates a .txt file in app\storage\app\reports e.g. 
    
    app\storage\app\reports\weather_report_2025-06-16.txt

Command example in app\Console\Commands\kernal.php:

    app:forecast-report Brisbane GoldCoast Maroochydore
