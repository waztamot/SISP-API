<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Security\Http\Controllers\Auth'], function () {
  
  Route::post('/login', 'LoginController@login');
  Route::get('/test', 'LoginController@test');
  Route::post('/user','LoginController@user');
  Route::post('/permissions','LoginController@permissions');
  Route::post('/modules', 'LoginController@modules');
});

Route::group(['namespace' => 'Security\Http\Controllers'], function () {
  
  Route::get('/permit', 'PermitController@index');
});



/*Route::group(['prefix' => 'seguridad', 'namespace' => 'Security\Http\Controllers'], function() {
  Route::get('/', 'SeguridadController@index');
});*/