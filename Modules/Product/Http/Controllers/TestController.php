<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Repositories\DeliveryRepository;
use SISP\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getTest()
    {
        return \Modules\Product\Repositories\DeliveryRepository::countDelivery('91593d7a-f508-5c81-82e1-f9c332a423cb');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function postTest()
    {
        // $repo = new \Modules\Product\Repositories\RequisitionRepository();
        // $mana = new \Modules\Product\Managers\DeliveryManager();
        // return  $mana->countDeliveryAvailable('22264602');
        return  \Modules\Product\Entities\Delivery::with(['details'])->get();
    }

}
