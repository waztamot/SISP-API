<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Seguridad\Http\Controllers\Auth'], function () {
  
  Route::post('/login', 'LoginController@login');
  Route::get('/test', 'LoginController@test');
  Route::post('/logout','LoginController@logout');
});



/*Route::group(['prefix' => 'seguridad', 'namespace' => 'Seguridad\Http\Controllers'], function() {
  Route::get('/', 'SeguridadController@index');
});*/