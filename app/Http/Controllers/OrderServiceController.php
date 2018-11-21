<?php

namespace App\Http\Controllers;

use App\OrderService;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function show(OrderService $orderService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderService $orderService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderService $orderService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $subOrder = OrderService::find($id);
        
        \DB::table('orders')->where('id', $subOrder->id_order)->decrement('monto', $subOrder->monto);
        \DB::table('orders')->where('id', $subOrder->id_order)->update(['descuento' => 0]);
        OrderService::destroy($id);
        
        return redirect()->back();
    }
}
