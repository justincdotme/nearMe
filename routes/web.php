<?php

$app->get('/', function () {
    return view('home')
        ->with([
            'gMapApiKey' => env('GOOGLE_MAP_APIKEY')
        ]);
});

//TODO - Temp route for initial coding of details view.
$app->get('details', function () {
    return view('details')
        ->with([
            'gMapApiKey' => env('GOOGLE_MAP_APIKEY')
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