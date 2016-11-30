<?php

Route::group(['prefix' => 'product', 'namespace' => 'Product\Http\Controllers'], function()
{
  // Route::get('/', 'ProductController@index');

  Route::group(['prefix' => 'combo',], function () {
    Route::post('/list', 'ComboController@getListCombo');
  });

  Route::group(['prefix' => 'requisition',], function () {

    Route::group(['prefix'=> 'individual',], function () {
      Route::post('/', 'RequisitionController@store');         //  Store
      // Route::put('/{id}', 'RequisitionController@update');
      Route::delete('/{id}', 'RequisitionController@delete');
      Route::post('/list', 'RequisitionController@list');     //  List
    });
    Route::group(['prefix'=> 'group',], function () {
      
    });
    //Route::post('/list', 'RequisitionController@');
  });



});
