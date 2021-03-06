<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use Illuminate\Http\Request;
use App\Facturar;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function __construct()
    {
        Facturar::facturar();
    }
    
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
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $subOrder = OrderProduct::find($id);
        
        \DB::table('orders')->where('id', $subOrder->id_order)->decrement('monto', $subOrder->monto * $subOrder->cantidad);
        \DB::table('orders')->where('id', $subOrder->id_order)->update(['descuento' => 0]);
        \DB::table('products')->where('id', $subOrder->id_producto)->increment('quedan', $subOrder->cantidad);
        OrderProduct::destroy($id);
        
        return redirect()->back();
    }
}
