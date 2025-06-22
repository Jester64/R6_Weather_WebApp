<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vite Entrypoints Manifest
    |--------------------------------------------------------------------------
    |
    | This option defines the path to the Vite manifest file that is generated
    | when the Vite build process runs. Laravel uses this manifest to load
    | your compiled assets and determine file versioning and integrity.
    |
    */

    'manifest_path' => public_path('build/manifest.json'),

    /*
    |--------------------------------------------------------------------------
    | Vite Development Server
    |--------------------------------------------------------------------------
    |
    | When developing your application using Vite and the development server,
    | you may specify the URL that your Vite server is running on. Laravel
    | will use this URL to load your assets during development sessions.
    |
    */

    // 'dev_server' => [
    //     'url' => env('VITE_DEV_SERVER_URL', 'http://localhost:5173'),
    // ],
];