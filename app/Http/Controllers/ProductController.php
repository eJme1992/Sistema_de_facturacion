<?php

namespace App\Http\Controllers;

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\ProductCategory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barra = new DNS1D();
        $categories = ProductCategory::all();
        $products = Product::all();
        $type = "producto";
        
        return view('products.index', compact('products','categories','type','barra'));
    }

    public function filter(Request $request)
    {
        $barra = new DNS1D();
        $categories = ProductCategory::all();
        $products = Product::all()->where('id_categoria', $request->id_categoria);
        //dd($request->id_categoria);
        $type = "producto";
        
        return view('products.index', compact('products','categories','type','barra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = "producto";
        $categories = ProductCategory::all();
        return view('products.create', compact('categories','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('archivo');
        //obtenemos la extension del archivo
        $ext = $file->getClientOriginalExtension();
        $filename = $request->codigo . "." . $ext;
        //dd($filename);
        
        Storage::disk('local')->put($filename,  \File::get($file));
        
        Product::create([
            'nombre' => $request['nombre'],
            'id_categoria' => $request['id_categoria'],
            'codigo' => $request['codigo'],
            'pedido' => $request['pedido'],
            'quedan' => $request['pedido'],
            'costo' => $request['costo'],
            'monto' => $request['monto'],
            'archivo' => $filename
        ]);
        
        return redirect()->route('products.create')->with('message', 'El producto fue creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if ($product == null) 
        {
            return view('errors.404');
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = "producto";
        $categories = ProductCategory::all();
        $product = Product::find($id);
        return view('products.edit', compact('product','categories','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'id_categoria' => 'required',
            'codigo' => 'required',
            'pedido' => 'required',
            'quedan' => 'required',
            'costo' => 'required',
            'monto' => 'required',
        ]);
        
        $file = $request->file('archivo');
        if ($file != null)
        {
            //obtenemos la extension del archivo
            $ext = $file->getClientOriginalExtension();
            $filename = $request->codigo . "." . $ext;
            $data['archivo'] = $filename;
            Storage::disk('local')->put($filename,  \File::get($file));
        }
        
        if($data['pedido'] == "0")
        {
            array_forget($data, 'pedido');
            array_forget($data, 'quedan');
        }
        else 
        {
            $data['quedan'] = $data['pedido'] + $data['quedan'];
        }
        
        $product->update($data);
        
        return redirect("/admin/productos/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        Storage::delete($product->archivo);
        $product->delete();
        
        return redirect('/admin/productos/');
    }
}
