<?php

namespace Modules\Product\Http\Controllers;

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
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getListCombo()
    {
      $combo_list = $this->comboRepo->list();
      
      foreach ($combo_list as $key => $value) {
        
        if ($value->type === 'SubCombo') {
          unset($combo_list[$key]['detail']);
          $combo_list[$key]['detail'] = $value->subcombo;
        }
        
        unset($combo_list[$key]['subcombo']);
      }

      return response()->json(compact('combo_list'), 200);
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
