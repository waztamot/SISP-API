<?php

namespace Modules\Product\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
    if (auth()->user()->hasRole('admin') || auth()->user()->can('product.combo.list')) {
      $combo_list = $this->comboRepo->list();

      foreach ($combo_list as $key_combo => $value_combo) {
        if ($value_combo->type === 'SubCombo') {
          unset($combo_list[$key_combo]['details']);
          $combo_list[$key_combo]['details'] = $value_combo->subcombo;
        }

        /*foreach ($combo_list[$key_combo]['details'] as $key_detail => $value_detail) {
          unset($combo_list[$key_combo]['details'][$key_detail]['product']['price']);
          $combo_list[$key_combo]['details'][$key_detail]['product']['price'] = $value_detail->product->price->price;
          //dd($combo_list[$key_combo]['details'][$key_detail]['product']['price'] );
          //= $value_detail->product->price->price;
          // dd($combo_list[$key]['details']['product']);
          // $combo_list[$key]['price'] = $value->price->price;
        }*/

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
