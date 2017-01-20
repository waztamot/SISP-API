<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-10-31 18:51:48
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-03 14:53:59
 */

Route::group(['prefix' => 'product', 'namespace' => 'Product\Http\Controllers'], function()
{

  // Probar cualquier duda con entity and repositories
  Route::group(['prefix' => 'test', ], function () {
    Route::get('/', 'TestController@getTest');
    Route::post('/', 'TestController@postTest');
  });

  Route::group(['prefix' => 'combo',], function () {
    Route::post('/list', 'ComboController@getListCombo');
  });

  Route::group(['prefix' => 'requisition',], function () {

    Route::group(['prefix'=> 'individual',], function () {
      Route::post('/', 'RequisitionController@store');                  //  store - Insert
      // Route::put('/{id}', 'RequisitionController@update');           
      Route::delete('/{id}', 'RequisitionController@delete');           
      Route::post('/list', 'RequisitionController@getRequisitions');    
      Route::post('/list/all', 'RequisitionController@list');           //  List 
    });
    Route::group(['prefix'=> 'group',], function () {
      
    });
  });

  Route::group(['prefix' => 'delivery',], function () {
    
    Route::group(['prefix'=> 'individual',], function () {
      Route::post('/requisitions', 'DeliveryController@getRequisitions');
      Route::post('/', 'DeliveryController@store');                       //  store - Insert
    });

    Route::group(['prefix'=> 'group',], function () {
      
    });
  });

});
