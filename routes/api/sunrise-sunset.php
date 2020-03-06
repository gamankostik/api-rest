<?php

Route::get('/sunrise-sunsets', [
    'as' => 'get-api-sunrise-sunset',
    'uses' => 'SunriseSunsetController@index'
]);
