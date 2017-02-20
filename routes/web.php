<?php

$app->get('/', function () {
    return view('home')
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