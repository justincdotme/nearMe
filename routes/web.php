<?php

$app->get('/', function () {
    return view('home')
        ->with([
            'gMapApiKey' => env('GEOCODE_GOOGLE_APIKEY'),
            'gaCode' => env('GOOGLE_ANALYTICS')
        ]);
});

$app->get('address',[
    'as' => 'stations.address',
    'uses' => 'StationController@searchByAddress'
]);

$app->get('coords',[
    'as' => 'stations.coords',
    'uses' => 'StationController@searchByCoords'
]);