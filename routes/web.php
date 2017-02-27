<?php

$app->get('/', function () {
    return view('home')
        ->with([
            'gMapApiKey' => env('GEOCODE_GOOGLE_APIKEY')
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