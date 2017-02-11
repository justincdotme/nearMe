<?php

$app->post('address',[
    'as' => 'stations.address',
    'uses' => 'StationController@searchByAddress'
]);

$app->post('coords',[
    'as' => 'stations.coords',
    'uses' => 'StationController@searchByCoords'
]);