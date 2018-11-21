<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');

Route::group(['middleware' => 'is_admin'], function () 
{
    // <-- Servicios -->
        
    Route::get('/admin/servicios', 'ServiceController@index')->name('services.index');

    Route::get('/admin/servicios/nuevo', 'ServiceController@create')->name('services.create');

    Route::post('/admin/servicios', 'ServiceController@store');

    Route::get('/admin/servicios/{id}/editar', 'ServiceController@edit')->name('services.edit');

    Route::put('/admin/servicios/{service}', 'ServiceController@update');

    Route::delete('/admin/servicios/{service}', 'ServiceController@delete')->name('services.delete');

    // <-- Productos -->
        
    Route::get('/admin/productos', 'ProductController@index')->name('products.index');

    Route::post('/admin/productos/filtro', 'ProductController@filter');

    Route::get('/admin/productos/nuevo', 'ProductController@create')->name('products.create');

    Route::post('/admin/productos', 'ProductController@store');

    Route::get('/admin/productos/{id}/editar', 'ProductController@edit')->name('products.edit');

    Route::put('/admin/productos/{product}', 'ProductController@update');

    Route::delete('/admin/productos/{product}', 'ProductController@delete')->name('products.delete');

    // <-- Categorias de productos -->
        
    Route::get('/admin/categorias', 'ProductCategoryController@index')->name('categories.index');

    Route::get('/admin/categorias/nueva', 'ProductCategoryController@create')->name('categories.create');

    Route::post('/admin/categorias', 'ProductCategoryController@store');

    Route::get('/admin/categorias/{id}/editar', 'ProductCategoryController@edit')->name('categories.edit');

    Route::put('/admin/categorias/{category}', 'ProductCategoryController@update');

    Route::delete('/admin/categorias/{category}', 'ProductCategoryController@delete')->name('categories.delete');

    // <-- Control -->
        
    Route::get('/admin/control/', 'ControlController@inicio')->name('control.caja.inicio');

    Route::get('/admin/control/caja/inicio', 'ControlController@inicio')->name('control.caja.inicio');

    Route::get('/admin/control/caja/cierre/', 'ControlController@cierre')->name('control.caja.cierre');

    Route::post('/admin/control/', 'ControlController@store');
    
    Route::delete('/admin/control/{id}', 'ControlController@delete')->name('control.delete');

    Route::get('/admin/control/caja/retiros', 'ControlController@retiros')->name('control.caja.retiros');

    Route::post('/admin/control/caja/retiros', 'ControlController@historial_retiros');

    // Control.Gastos

    Route::get('/admin/control/gastos/limpieza', 'ControlController@gastos')->name('control.gastos.limpieza');

    Route::get('/admin/control/gastos/servicios', 'ControlController@gastos')->name('control.gastos.servicios');

    Route::get('/admin/control/gastos/mercaderias', 'ControlController@gastos')->name('control.gastos.mercaderias');

    Route::get('/admin/control/gastos/comida', 'ControlController@gastos')->name('control.gastos.comida');

    Route::get('/admin/control/gastos/contador', 'ControlController@gastos')->name('control.gastos.contador');

    Route::post('/admin/control/gastos/limpieza', 'ControlController@historial_gastos');

    Route::post('/admin/control/gastos/servicios', 'ControlController@historial_gastos');

    Route::post('/admin/control/gastos/mercaderias', 'ControlController@historial_gastos');

    Route::post('/admin/control/gastos/comida', 'ControlController@historial_gastos');

    Route::post('/admin/control/gastos/contador', 'ControlController@historial_gastos');

    // Control.Ingresos

    Route::get('/admin/control/ingresos/productos', 'ControlController@ordenes')->name('control.ingresos.productos');

    Route::get('/admin/control/ingresos/servicios', 'ControlController@ordenes')->name('control.ingresos.servicios');

    Route::post('/admin/control/ingresos/productos', 'ControlController@store_orden');

    Route::post('/admin/control/ingresos/servicios', 'ControlController@store_orden');

    Route::post('/admin/control/ingresos/productos/historial', 'ControlController@historial_ordenes');

    Route::post('/admin/control/ingresos/servicios/historial', 'ControlController@historial_ordenes');
    //---DESCUENTO en ORDEN---//
    Route::post('/admin/control/productos/descuento/{id_order}', 'ControlController@descuento_orden');
    
    Route::post('/admin/control/servicios/descuento/{id_order}', 'ControlController@descuento_orden');
    //-----------FIN----------//
    //---CERRAR ORDEN---//
    Route::post('/admin/control/productos/cerrar/{id_order}', 'ControlController@cerrar_orden');
    
    Route::post('/admin/control/servicios/cerrar/{id_order}', 'ControlController@cerrar_orden');
    //-----------FIN----------//
    Route::get('/admin/control/ingresos/productos/{id_order}', 'ControlController@subordenes')->name('control.ingresos.productos.agregar');

    Route::get('/admin/control/ingresos/servicios/{id_order}', 'ControlController@subordenes')->name('control.ingresos.servicios.agregar');

    Route::post('/admin/control/ingresos/productos/{id_order}', 'ControlController@store_suborden');

    Route::post('/admin/control/ingresos/servicios/{id_order}', 'ControlController@store_suborden');

    Route::delete('/admin/order/{id}', 'OrderController@delete')->name('order.delete');

    Route::delete('/admin/control/ingresos/productos/{id}', 'OrderProductController@delete');

    Route::delete('/admin/control/ingresos/servicios/{id}', 'OrderServiceController@delete');

    // Control.Sueldos

    Route::get('/admin/control/sueldos/', 'ControlController@sueldos')->name('control.sueldos');

    Route::post('/admin/control/sueldos/historial', 'ControlController@historial_sueldos_all');

    Route::post('/admin/control/sueldos/{nombre}', 'ControlController@historial_sueldos_one');

    // Control.Comisiones

    Route::get('/admin/control/comisiones/', 'ControlController@comisiones')->name('control.comisiones');

    Route::post('/admin/control/comisiones/historial', 'ControlController@historial_comisiones_all');

    Route::post('/admin/control/comisiones/{nombre}', 'ControlController@historial_comisiones_one');

    // Control.Adelantos

    Route::get('/admin/control/adelantos/', 'ControlController@adelantos')->name('control.adelantos');

    Route::post('/admin/control/adelantos/historial', 'ControlController@historial_adelantos_all');

    Route::post('/admin/control/adelantos/{nombre}', 'ControlController@historial_adelantos_one');

    // Control.Movimientos

    Route::get('/admin/control/movimientos/', 'ControlController@movimientos')->name('control.movimientos');

    Route::post('/admin/control/movimientos/historial', 'ControlController@historial_movimientos');

    // <-- Usuarios -->
        
    Route::get('/admin/{type}s', 'UserController@index')->name('users.index');

    Route::get('/admin/{type}s/papelera', 'UserController@papelera');

    Route::delete('/admin/{type}s/{user}/resurrect', 'UserController@resurrect')->name('users.resurrect');

    Route::get('/admin/{type}s/nuevo', 'UserController@create')->name('users.create');

    Route::post('/admin/{type}s', 'UserController@store');

    Route::get('/admin/{type}s/{nombre}', 'UserController@show')->name('users.show'); // ID por USER

    Route::get('/admin/{type}s/{nombre}/editar', 'UserController@edit')->name('users.edit');

    Route::put('/admin/{type}s/{user}', 'UserController@update')->name('users.update');

    Route::delete('/admin/{type}s/{user}', 'UserController@delete')->name('users.delete');

    Route::get('/admin/clientes/{nombre}/historial', 'UserController@record')->name('users.record');

    Route::post('/admin/clientes/{nombre}/historial', 'UserController@historial_record');
    
});