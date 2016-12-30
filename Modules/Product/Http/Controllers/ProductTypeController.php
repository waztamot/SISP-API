<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-08 11:37:07
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-23 14:23:52
 */

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SISP\Http\Controllers\Controller;

/**
 * Class of type Controller by table ProductType
 * @author Javier Alarcon
 */
class ProductTypeController extends Controller
{
    /**
     * construct function - constructor of the class
     *
     * @return void
     * @author Javier Alarcon
     */
    public function __construct() 
    {
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
