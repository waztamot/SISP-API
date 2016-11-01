<?php

Route::group(['middleware' => 'web', 'prefix' => 'firm', 'namespace' => 'Modules\Firm\Http\Controllers'], function()
{
    Route::get('/', 'FirmController@index');
});
