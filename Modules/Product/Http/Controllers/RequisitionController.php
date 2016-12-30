<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Http\Requests\RequisitionRequest;
use Modules\Product\Managers\RequisitionManager;
use Modules\Product\Repositories\RequisitionRepository;
use Modules\Product\Repositories\StaffRepository;
use SISP\Http\Controllers\Controller;
use SISP\Utils\Helpers;

class RequisitionController extends Controller
{
  
  protected $requisitionRepo;
  protected $staffRepo;
  protected $requisitionManager;

  public function __construct(RequisitionRepository $requisitionRepo, StaffRepository $staffRepo) 
  {
    $this->requisitionRepo = $requisitionRepo;
    $this->staffRepo = $staffRepo;
    $this->middleware('jwt.auth');
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
  public function show($id)
  {
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
  public function delete($id)
  {
    if (!$this->requisitionRepo->destroy($id)) {
      throw new SISPException('No se pudo eliminar el pedido', 601);
    }
    return response()->json(['result' => true], 200);
  }
}
