<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Seguridad\Http\Controllers\Auth'], function () {
  
  Route::post('/login', 'LoginController@login');
  Route::get('/test', 'LoginController@test');
  Route::post('user','LoginController@usuario');
  Route::post('/permissions','LoginController@permisos');
  
});



/*Route::group(['prefix' => 'seguridad', 'namespace' => 'Seguridad\Http\Controllers'], function() {
  Route::get('/', 'SeguridadController@index');
});*/