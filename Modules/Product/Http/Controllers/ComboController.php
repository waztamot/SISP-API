<?php

namespace Modules\Product\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Managers\ComboManager;
use SISP\Http\Controllers\Controller;

class ComboController extends Controller
{

  public function __construct() 
  {
    $this->middleware('jwt.auth', ['except' => 'login'] );
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function getListCombo()
  {
    $user = auth()->user();

    if ($user->hasRole(['admin','empleado']) || $user->can('product.request')) {

      $comboManager = new ComboManager();
      $comboManager->init(['data' => [], 'user' => $user]);

      $combos = $comboManager->constructorMany();
      $combos = $comboManager->addRequisition($combos);

      return response()->json(['data' => $combos], 200);
    } else {
      return response()->json(['error' => trans('validation.custom.access.denied')], 200);
    }

  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    return view('product::create');
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit()
  {
    return view('product::edit');
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request)
  {
  }

  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function destroy()
  {
  }
}
