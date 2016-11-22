<?php

namespace Modules\Product\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use SISP\Http\Controllers\Controller;
use Modules\Product\Repositories\ComboRepository;

class ComboController extends Controller
{
  protected $comboRepo;

  public function __construct(ComboRepository $comboRepo) 
  {
    $this->comboRepo = $comboRepo;
    $this->middleware('jwt.auth', ['except' => 'login'] );
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function getListCombo()
  {
    $user = Auth::user();

    if ($user->hasRole(['admin','empleado']) || $user->can('product.request')) {

      $combo_list = $this->comboRepo->list($user->company_id);

      foreach ($combo_list as $key_combo => $value_combo) {

        $combo_list[$key_combo]['buy'] = false;               //  Crear Busqueda

        if ($value_combo->type === 'SubCombo') {
          unset($combo_list[$key_combo]['details']);
          $combo_list[$key_combo]['details'] = $value_combo->subcombo;
        }

        unset($combo_list[$key_combo]['subcombo']);

      }
      return response()->json(['data' => $combo_list], 200);
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
