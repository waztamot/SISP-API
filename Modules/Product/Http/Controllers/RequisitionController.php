<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Http\Requests\RequisitionRequest;
use Modules\Product\Managers\RequisitionManager;
use Modules\Product\Repositories\RequisitionRepository;
use SISP\Http\Controllers\Controller;
use SISP\Utils\Helpers;

class RequisitionController extends Controller
{
  
  protected $requisitionRepo;

  public function __construct(RequisitionRepository $requisitionRepo) 
  {
    $this->requisitionRepo = $requisitionRepo;
    // $this->middleware('jwt.auth', ['except' => 'login'] s);
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function list()
  {
    return $this->requisitionRepo->allActive();
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(RequisitionRequest $request)
  {
    $result = array();
    $manager = new RequisitionManager();

    $manager->init(['data' => $request, 'user' => auth()->user()]);
    $result = $manager->store();

    return response()->json($result, 200);
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
