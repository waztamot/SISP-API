<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SISP\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getTest()
    {
        return ;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function postTest()
    {
        return \Modules\Security\Entities\Company::/*with(['lapse','details'])->*/get();
    }

}
