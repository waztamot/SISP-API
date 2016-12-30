<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Managers\DeliveryManager;
use Modules\Product\Repositories\DeliveryRepository;
use Modules\Product\Repositories\StaffRepository;
use SISP\Http\Controllers\Controller;

class DeliveryController extends Controller
{

  public function __construct(DeliveryRepository $deliveryRepo, StaffRepository $staffRepo) 
  {
    $this->deliveryRepo = $deliveryRepo;
    $this->staffRepo = $staffRepo;
    $this->middleware('jwt.auth');
  }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product::index');
    }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function getRequisitions(Request $request)
  {
    $user = auth()->user();
    $identification = $request->get('identification');

    $deliveryManager = new DeliveryManager();
    $deliveryManager->init(['data' => $request, 'user' => $user]);
    
    $employee = $this->staffRepo->find($identification);
    $combos = $deliveryManager->getCombos($employee);
    $requisitions = $deliveryManager->getRequisitions($employee->identification);
    
    return response()->json(['result' => true, 'employee' => $employee, 'requisitions' => $requisitions, 'combos' => $combos], 200);
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
