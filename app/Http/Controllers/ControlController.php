<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Control;
use App\User;
use App\Order;
use App\OrderService;
use App\OrderProduct;
use App\Service;
use App\Product;
use \App\FormaPago;
use Carbon;

class ControlController extends Controller
{
    public function inicio()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->where('id_desc', 1)->exists();

        $controls = Control::where('id_desc', 1)
                    ->where('caja_abierta', 1)
                    ->get();
        $titulo = "Caja inicial";

        return view('control.caja.inicio', compact('controls', 'titulo', 'caja_abierta'));
    }

    public function cierre()
    {
        \DB::table('controls')
            ->where('caja_abierta', 1)
            ->update(['caja_abierta' => 0]);

            \DB::table('orders')
            ->where('deHoy', 1)
            ->update(['deHoy' => 0]);

        return redirect()->route('control.caja.inicio');
    }

    public function retiros()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            $controls = \DB::table('controls')
                    ->where('caja_abierta', 1)
                    ->where('id_desc', '=', 6)
                    ->get();

            $titulo = "Retiros del día";
            return view('control.caja.retiros', compact('controls', 'titulo'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_retiros(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', 6)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Retiros desde el " . $desde . " hasta el " . $hasta;

        return view('control.caja.retiros', compact('controls', 'titulo'));
    }

    public function gastos()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            if (\Request::is('*/limpieza'))
            {
                $nombre = "limpieza"; $id_desc = 3;
            }
            else if(\Request::is('*/servicios'))
            {
                $nombre = "servicios"; $id_desc = 4;
            }
            else if(\Request::is('*/mercaderias'))
            {
                $nombre = "mercaderias"; $id_desc = 7;
            }
            else if(\Request::is('*/comida'))
            {
                $nombre = "comida"; $id_desc = 9;
            }
            else if(\Request::is('*/contador'))
            {
                $nombre = "contador"; $id_desc = 10;
            }
            else {}

            $controls = \DB::table('controls')
                        ->where('caja_abierta', 1)
                        ->where('id_desc', '=', $id_desc)
                        ->get();

            $titulo = "Gastos de " . $nombre . " del día";

            return view('control.gastos.index', compact('controls', 'titulo', 'nombre', 'id_desc'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_gastos(Request $request)
    {
        if (\Request::is('*/limpieza'))
        {
            $nombre = "limpieza"; $id_desc = 3;
        }
        else if(\Request::is('*/servicios'))
        {
            $nombre = "servicios"; $id_desc = 4;
        }
        else if(\Request::is('*/mercaderias'))
        {
            $nombre = "mercaderias"; $id_desc = 7;
        }
        else if(\Request::is('*/comida'))
        {
            $nombre = "comida"; $id_desc = 9;
        }
        else if(\Request::is('*/contador'))
        {
            $nombre = "contador"; $id_desc = 10;
        }
        else {}

        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Gastos de " . $nombre . " desde " . $desde . " hasta " . $hasta;

        return view('control.gastos.index', compact('controls', 'titulo', 'nombre'));
    }

    public function sueldos()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            $tipo = "empleados";
            $id_uType = 2;
            $empleados = \DB::table('users')->where([['id_uType', $id_uType],['activo', 1]])->select('id','nombre')->orderBy('nombre')->get();
            $titulo = "Sueldos de " . $tipo;

            return view('control.sueldos.index', compact('empleados', 'titulo', 'tipo'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_sueldos_all(Request $request)
    {
        $tipo = "empleados";
        $id_desc = 5;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Sueldos de " . $tipo . " desde " . $desde . " hasta " . $hasta;

        return view('control.sueldos.index', compact('controls', 'titulo', 'tipo'));
    }

    public function historial_sueldos_one(Request $request, $nombre)
    {
        $tipo = "empleados";
        $id_desc = 5;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->where('detalle', 'like', '%'.$nombre.'%')
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Sueldos de " . strtoupper($nombre) . " desde " . $desde . " hasta " . $hasta;

        return view('control.sueldos.index', compact('controls', 'titulo', 'nombre', 'tipo'));
    }

    public function comisiones()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            $id_uType = 2;
            $empleados = \DB::table('users')->where([['id_uType', $id_uType],['activo', 1]])->select('id','nombre')->orderBy('nombre')->get();

            $mP = Carbon::now()->month - 1;
            $mS = Carbon::now()->month + 1;
            $day = Carbon::now()->day;

            if($day > 10)
            {
                $desde = Carbon::createFromDate(null, null, 10)->setTime(06, 00, 00);
                $hasta = Carbon::createFromDate(null, $mS, 10)->setTime(06, 00, 00);
            }
            else
            {
                $desde = Carbon::createFromDate(null, $mP, 10)->setTime(06, 00, 00);
                $hasta = Carbon::createFromDate(null, null, 10)->setTime(06, 00, 00);
            }

            $ordenes_serv = \DB::table('orders')->where('id_type', 2)->whereBetween('created_at', [$desde, $hasta])->select('id_empleado','monto','descuento')->get();
            $ordenes_prod = \DB::table('orders')->where('id_type', 1)->whereBetween('created_at', [$desde, $hasta])->select('id_empleado','monto','descuento')->get();

            $tipo = "empleados";
            $titulo = "Comisiones de " . $tipo;

            return view('control.comisiones.index', compact('empleados', 'titulo', 'tipo', 'ordenes_serv', 'ordenes_prod'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_comisiones_all(Request $request)
    {
        $tipo = "empleados";
        $id_desc = 2;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Comisiones de " . $tipo . " desde " . $desde . " hasta " . $hasta;

        return view('control.comisiones.index', compact('controls', 'titulo', 'tipo'));
    }

    public function historial_comisiones_one(Request $request, $nombre)
    {
        $tipo = "empleados";
        $id_desc = 2;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->where('detalle', 'like', '%'.$nombre.'%')
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Comisiones de " . strtoupper($nombre) . " desde " . $desde . " hasta " . $hasta;

        return view('control.comisiones.index', compact('controls', 'titulo', 'nombre', 'tipo'));
    }

    public function adelantos()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            $id_uType = 2;
            $empleados = \DB::table('users')->where([['id_uType', $id_uType],['activo', 1]])->select('id','nombre')->orderBy('nombre')->get();

            $mP = Carbon::now()->month - 1;
            $mS = Carbon::now()->month + 1;
            $day = Carbon::now()->day;

            if($day > 10)
            {
                $desde = Carbon::createFromDate(null, null, 10)->setTime(06, 00, 00);
                $hasta = Carbon::createFromDate(null, $mS, 10)->setTime(06, 00, 00);
            }
            else
            {
                $desde = Carbon::createFromDate(null, $mP, 10)->setTime(06, 00, 00);
                $hasta = Carbon::createFromDate(null, null, 10)->setTime(06, 00, 00);
            }

            $tipo = "empleados";
            $titulo = "Adelantos a " . $tipo;

            return view('control.adelantos.index', compact('empleados', 'titulo', 'tipo'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_adelantos_all(Request $request)
    {
        $tipo = "empleados";
        $id_desc = 8;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Adelantos a " . $tipo . " desde " . $desde . " hasta " . $hasta;

        return view('control.adelantos.index', compact('controls', 'titulo', 'tipo'));
    }

    public function historial_adelantos_one(Request $request, $nombre)
    {
        $tipo = "empleados";
        $id_desc = 8;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->where('detalle', 'like', '%'.$nombre.'%')
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Adelantos a " . strtoupper($nombre) . " desde " . $desde . " hasta " . $hasta;

        return view('control.adelantos.index', compact('controls', 'titulo', 'nombre', 'tipo'));
    }

    public function ordenes()
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        if($caja_abierta)
        {
            if (\Request::is('*/productos'))
            {
                $tipo = "productos";
                $id_type = 1;
            }
            else if(\Request::is('*/servicios'))
            {
                $tipo = "servicios";
                $id_type = 2;
            }
            $orders = \DB::table('orders')->where('id_type', $id_type)->where('deHoy', 1)->get();
            $empleados = \DB::table('users')->select('id', 'nombre', 'activo')->where([['id_uType',"!=", 3], ['id',"!=", 1],])->orderBy('nombre')->get();
            $clientes = \DB::table('users')->select('id', 'nombre', 'activo')->where('id_uType', 3)->orderBy('nombre')->get();
            $formasPago = \DB::table('formas_pago')->select('id', 'nombre')->get();
            $titulo = "Ingresos por " . $tipo . " del día";

            return view('control.ingresos.index', compact('titulo', 'tipo', 'empleados', 'clientes', 'formasPago', 'id_type', 'orders'));
        }
        else
        {
            return view('control.cajaCerrada');
        }
    }

    public function historial_ordenes(Request $request)
    {
        if (\Request::is('*/productos/historial'))
        {
            $tipo = "productos"; $id_type = 1;
        }
        else if(\Request::is('*/servicios/historial'))
        {
            $tipo = "servicios"; $id_type = 2;
        }

        $desde = $request->desde;
        $hasta = $request->hasta;
        $orders = \DB::table('orders')
                    ->where('id_type', '=', $id_type)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        //dd($orders);
        $empleados = \DB::table('users')->select('id', 'nombre', 'activo')->where('id_uType', "!=", 3)->orderBy('nombre')->get();
        $clientes = \DB::table('users')->select('id', 'nombre')->where('id_uType', 3)->orderBy('nombre')->get();
        $formasPago = \DB::table('formas_pago')->select('id', 'nombre')->get();

        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Ingresos por " . $tipo . " desde " . $desde . " hasta " . $hasta;

        return view('control.ingresos.index', compact('titulo', 'tipo', 'empleados', 'clientes', 'formasPago', 'id_type', 'orders'));
    }

    public function store_orden(Request $request)
    {
        $order = Order::create([
            'id_empleado' => $request['id_empleado'],
            'id_cliente' => $request['id_cliente'],
            'id_type' => $request['id_type'],
            'id_forma_pago' => $request['id_forma_pago'],
            'monto' => $request['monto'],
            'pago_efec' => $request['pago_efec'],
            'pago_tarj' => $request['pago_tarj'],
            'descuento' => $request['descuento'],
            'completada' => $request['completada'],
            'deHoy' => $request['deHoy']
        ]);

        $id_order = $order->id;

        switch ($request['id_type'])
        {
            case '1':
                return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
                break;

            case '2':
                return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
                break;

            default:
                # code...
                break;
        }
    }

    public function subordenes($id_order)
    {
        if (\Request::is('*/productos/*'))
        {
            $tipo = "productos";
            $id_type = 1;
            $productos = \DB::table('products')->get();
            $orders_indiv = \DB::table('orders_products')->where('id_order', $id_order)->get();
        }
        else if(\Request::is('*/servicios/*'))
        {
            $tipo = "servicios";
            $id_type = 2;
            $servicios = \DB::table('services')->get();
            $orders_indiv = \DB::table('orders_services')->where('id_order', $id_order)->get();
        }

        $order = Order::find($id_order);
        if ($order!=null)
        {
            $empleado = User::find($order->id_empleado)->nombre;
            $cliente = User::find($order->id_cliente)->nombre;
            $formaPago = FormaPago::find($order->id_forma_pago)->nombre;
            $subtitulo = "Cliente: " . strtoupper($cliente) . " | Atendió: " . strtoupper($empleado);

            if ($order->completada == 0 || $order->id_forma_pago != 3)
            {
                $pie = "Forma de pago: " . strtoupper($formaPago);
            }
            else
            {
                $pie = "Forma de pago: " . strtoupper($formaPago) . " ( $" . $order->pago_efec . " / $" . $order->pago_tarj . " )";
            }
        }
        else
        {
            $subtitulo = "La orden todavía no existe";
        }

        $titulo = "Orden #" . $id_order;

        return view('control.ingresos.create', compact('titulo', 'subtitulo', 'pie', 'tipo', 'id_type', 'id_order', 'order', 'servicios', 'productos', 'orders_indiv'));
    }

    public function store_suborden(Request $request, $id_order)
    {
        if (\Request::is('*/productos/*'))
        {
            $id = $request->id_producto;
            $cant = $request->cantidad;
            $product = Product::find($id);
            $monto = $product->monto;

            OrderProduct::create([
                'id_order' => $request['id_order'],
                'id_producto' => $request['id_producto'],
                'cantidad' => $request['cantidad'],
                'monto' => $monto
            ]);

            \DB::table('orders')->where('id', $id_order)->increment('monto', $monto * $cant);
            \DB::table('products')->where('id', $id)->decrement('quedan', $cant);

            return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
        }
        else if(\Request::is('*/servicios/*'))
        {
            $id = $request->id_servicio;
            $service = Service::find($id);
            $monto = $service->monto;

            OrderService::create([
                'id_order' => $request['id_order'],
                'id_servicio' => $request['id_servicio'],
                'detalle' => $request['detalle'],
                'monto' => $monto
            ]);

            \DB::table('orders')->where('id', $id_order)->increment('monto', $monto);

            return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
        }
    }

    public function descuento_orden(Request $request, $id_order)
    {
        $descuento = $request->descuento;
        $order = Order::find($id_order);
        $monto = $order->monto;
        $descuento = $monto * $descuento /100;

        \DB::table('orders')->where('id', $id_order)->update(['descuento' => $descuento]);

        if (\Request::is('*/productos/*'))
        {
            return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
        }
        else if(\Request::is('*/servicios/*'))
        {
            return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
        }
    }

    public function cerrar_orden(Request $request, $id_order)
    {
        $order = Order::find($id_order);
        $pagado = $order->monto - $order->descuento;
        if ($order->id_forma_pago == 1) {
            \DB::table('orders')->where('id', $id_order)->update(['pago_efec' => $pagado]);
        }
        elseif ($order->id_forma_pago == 2) {
            \DB::table('orders')->where('id', $id_order)->update(['pago_tarj' => $pagado]);
        }
        else {
            \DB::table('orders')->where('id', $id_order)->update(['pago_efec' => $request->pago_efec]);
            \DB::table('orders')->where('id', $id_order)->update(['pago_tarj' => $request->pago_tarj]);
        }
        \DB::table('orders')->where('id', $id_order)->update(['completada' => 1]);

        if (\Request::is('*/productos/*'))
        {
            return redirect()->route('control.ingresos.productos');
        }
        else if(\Request::is('*/servicios/*'))
        {
            return redirect()->route('control.ingresos.servicios');
        }
    }

    public function store(Request $request)
    {
        Control::create([
            'admin' => $request['admin'],
            'monto' => $request['monto'],
            'id_desc' => $request['id_desc'],
            'detalle' => $request['detalle'],
            'caja_abierta' => $request['caja_abierta']
        ]);

        switch ($request['id_desc'])
        {
            case '1':
                return redirect()->route('control.caja.inicio');
                break;

            case '2':
                return redirect()->route('control.comisiones')->with('message', 'La comisión fue pagada correctamente.');
                break;

            case '3':
                return redirect()->route('control.gastos.limpieza');
                break;

            case '4':
                return redirect()->route('control.gastos.servicios');
                break;

            case '5':
                return redirect()->route('control.sueldos')->with('message', 'El sueldo fue pagado correctamente.');
                break;

            case '6':
                return redirect()->route('control.caja.retiros');
                break;

            case '7':
                return redirect()->route('control.gastos.mercaderias');
                break;

            case '8':
                return redirect()->route('control.adelantos')->with('message', 'El adelanto fue pagado correctamente.');
                break;

            case '9':
                return redirect()->route('control.gastos.comida');
                break;

            case '10':
                return redirect()->route('control.gastos.contador');
                break;

            default:
                # code...
                break;
        }
    }

    public function delete($id)
    {
        $control = Control::destroy($id);
        //return redirect()->route('control.caja.inicio');
        return redirect()->back();
    }

    public function movimientos()
    {
        $caja_inicial = Control::where('id_desc', 1)
                        ->where('caja_abierta', 1)
                        ->value(\DB::raw("sum(monto)")) + 0;
        //dd($caja_inicial);
        $ingXprod_efec = Order::where('deHoy', 1)
                        ->where('id_type', 1)
                        ->value(\DB::raw("sum(pago_efec)")) + 0;
        $ingXprod_tarj = Order::where('deHoy', 1)
                        ->where('id_type', 1)
                        ->value(\DB::raw("sum(pago_tarj)")) + 0;
        $ingXserv_efec = Order::where('deHoy', 1)
                        ->where('id_type', 2)
                        ->value(\DB::raw("sum(pago_efec)")) + 0;
        $ingXserv_tarj = Order::where('deHoy', 1)
                        ->where('id_type', 2)
                        ->value(\DB::raw("sum(pago_tarj)")) + 0;
        $gastXlimp = Control::where('caja_abierta', 1)
                        ->where('id_desc', 3)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXserv = Control::where('caja_abierta', 1)
                        ->where('id_desc', 4)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXmerc = Control::where('caja_abierta', 1)
                        ->where('id_desc', 7)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXcomi = Control::where('caja_abierta', 1)
                        ->where('id_desc', 9)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXcont = Control::where('caja_abierta', 1)
                        ->where('id_desc', 10)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $retiros = Control::where('caja_abierta', 1)
                        ->where('id_desc', 6)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $sueldos = Control::where('caja_abierta', 1)
                        ->where('id_desc', 5)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $comisiones = Control::where('caja_abierta', 1)
                        ->where('id_desc', 2)
                        ->value(\DB::raw("sum(monto)")) + 0;
        $adelantos = Control::where('caja_abierta', 1)
                        ->where('id_desc', 8)
                        ->value(\DB::raw("sum(monto)")) + 0;

        $total_efec = $caja_inicial + $ingXprod_efec + $ingXserv_efec - $gastXlimp - $gastXserv - $gastXmerc - $gastXcomi - $gastXcont - $retiros - $sueldos - $comisiones - $adelantos;
        $total_tarj = $ingXprod_tarj + $ingXserv_tarj;

        $titulo = "Movimientos del turno";

        return view('control.movimientos.index', compact('titulo', 'caja_inicial', 'ingXprod_efec', 'ingXserv_efec', 'ingXprod_tarj', 'ingXserv_tarj', 'gastXlimp', 'gastXserv', 'gastXmerc', 'gastXcomi', 'gastXcont', 'retiros', 'sueldos', 'comisiones', 'adelantos', 'total_efec', 'total_tarj'));
    }

    public function historial_movimientos(Request $request)
    {
        $desde = date('Y/m/d 06:00:00', strtotime($request->desde));
        $hasta = date('Y/m/d 06:00:00', strtotime($request->hasta));
        //dd($desde);
        $caja_inicial = Control::where('id_desc', 1)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        //dd($caja_inicial);
        $ingXprod_efec = Order::where('id_type', 1)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(pago_efec)")) + 0;
        $ingXprod_tarj = Order::where('id_type', 1)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(pago_tarj)")) + 0;
        $ingXserv_efec = Order::where('id_type', 2)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(pago_efec)")) + 0;
        $ingXserv_tarj = Order::where('id_type', 2)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(pago_tarj)")) + 0;
        $gastXlimp = Control::where('id_desc', 3)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXserv = Control::where('id_desc', 4)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXmerc = Control::where('id_desc', 7)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXcomi = Control::where('id_desc', 9)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $gastXcont = Control::where('id_desc', 10)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $retiros = Control::where('id_desc', 6)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $sueldos = Control::where('id_desc', 5)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $comisiones = Control::where('id_desc', 2)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;
        $adelantos = Control::where('id_desc', 8)
                        ->whereBetween('created_at', [$desde, $hasta])
                        ->value(\DB::raw("sum(monto)")) + 0;

        $total_efec = $caja_inicial + $ingXprod_efec + $ingXserv_efec - $gastXlimp - $gastXserv - $gastXmerc - $gastXcomi - $gastXcont - $retiros - $sueldos - $comisiones - $adelantos;
        $total_tarj = $ingXprod_tarj + $ingXserv_tarj;

        $desde = date('d/m/y', strtotime($request->desde));
        $hasta = date('d/m/y', strtotime($request->hasta));
        $titulo = "Movimientos desde " . $desde . " hasta " . $hasta;

        return view('control.movimientos.index', compact('titulo', 'caja_inicial', 'ingXprod_efec', 'ingXserv_efec', 'ingXprod_tarj', 'ingXserv_tarj', 'gastXlimp', 'gastXserv', 'gastXmerc', 'gastXcomi', 'gastXcont', 'retiros', 'sueldos', 'comisiones', 'adelantos', 'total_efec', 'total_tarj'));
    }
}
