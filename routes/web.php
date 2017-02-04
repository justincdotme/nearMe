<?php

$app->post('address',[
    'as' => 'pages.home',
    'uses' => 'LocationController@address'
]);

$app->post('coords/{lat}/{lng}',[
    'as' => 'pages.home',
    'uses' => 'LocationController@coords'
]);