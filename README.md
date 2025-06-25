Weather Forecast Web App (Laravel + React)

This application displays a 5-day weather forecast for selected Australian cities using the AccuWeather API. It’s built with a Laravel backend and a React + Vite frontend.


Setup Instructions

1. Install PHP, Laravel, and Composer

go to https://laravel.com/docs/12.x/installation#installing-php and follow the install steps

OR

Make sure PHP 8.1+ is installed. You can download it from php.net or install it via:

    Windows: XAMPP

    macOS: brew install php

    Linux: sudo apt install php

2. Clone the repo and install Laravel dependencies:

composer:

    composer install    

3. Set your API Key

Open .env and add your AccuWeather API key:

    ACCUWEATHER_API_KEY=your_api_key_here

4. Start the dev server

Use the following command to run both the Laravel server and frontend together:

    composer run dev

This starts:

    Laravel backend at: http://127.0.0.1:8000/

    Vite dev server (React) at: http://localhost:5173/ (used under the hood)

5. Access the App

Visit:

http://127.0.0.1:8000/

Use the dropdown to select a city and view the forecast.

Design Choices

React + Vite Frontend: React handles the dynamic UI, using useEffect and useState to manage city selection and loading state.

Laravel API: An endpoint at /api/forecast?city=CityName fetches and returns clean JSON data formatted for the frontend.

Fallback States: Includes UI handling for loading, errors, and no data conditions.

AccuWeather API: Offers accurate 5-day forecasts, accessed via a custom Laravel AccuWeatherService class, and is free to use.

Daily Report: Task Brief intro mentions daily generated report, but no details and expectations in Success Critiera:
    
Created app\Console\Commands\GenerateDailyForecastReport.php to gather forecast data that day from Brisbane, Gold Coast, and Sunshine Coast that genrates a txt file in app\storage\app\reports e.g. 
    
    app\storage\app\reports\weather_report_2025-06-16.txt

Tailwind CSS: Provides clean styling with utility classes for layout, spacing, and responsiveness.
