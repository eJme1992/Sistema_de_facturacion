<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $type = Order::find($id)->id_type;
        
        if($type == 1) 
        {
            $subOrdenes = \DB::table('orders_products')->where('id_order', $id)->get();
            
            foreach ($subOrdenes as $subOrden)
            {
                \DB::table('products')->where('id', $subOrden->id_producto)->increment('quedan', $subOrden->cantidad);
                OrderProduct::destroy($subOrden->id);
            }

        } 
        else if($type == 2)
        {
            \DB::table('orders_services')->where('id_order', $id)->delete();
        }
        
        Order::destroy($id);
        
        return redirect()->back();
    }
}
