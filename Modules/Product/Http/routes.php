<?php

Route::group(['prefix' => 'product', 'namespace' => 'Product\Http\Controllers'], function()
{
  // Route::get('/', 'ProductController@index');

  Route::group(['prefix' => 'combo',], function () {
    Route::post('/list', 'ComboController@getListCombo');
  });

});
