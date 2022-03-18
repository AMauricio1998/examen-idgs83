<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Tienda;
use App\Models\Venta;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class tiendaController extends Controller
{
    public function index() {
        $datos = Tienda::all();
        $ventas = Venta::with('tienda', 'empleado', 'producto')->get();

        return view('welcome')
            ->with(['datos' => $datos, 'ventas' => $ventas]);
    }
    
    public function fotoTienda(Request $request) {
        $tienda = Tienda::all();
        return response()->json($tienda);
    }

    public function fotoEmpleado(Request $request) {
        $empleado = Empleado::all();
        return response()->json($empleado);
    }

    public function productos() {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function altaProductosVentas(Request $request) {

        $request->validate([
            'nombre_clave' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
            'total' => 'required',
            'subtotal' => 'required',
            'descuento' => 'required',
            'id_tienda' => 'required',
            'id_empleado' => 'required',
            'id_producto' => 'required',
        ]);

        Venta::create([        
            'nombre_clave' => $request['nombre_clave'],
            'precio' => $request['precio'],
            'cantidad' => $request['cantidad'],
            'total' => $request['total'],
            'subtotal' => $request['subtotal'],
            'descuento' => $request['descuento'],
            'id_tienda' => $request['id_tienda'],
            'id_empleado' => $request['id_empleado'],
            'id_producto' => $request['id_producto'],
        ]);

        return redirect('/');
    }

    public function borrar(Venta $id) {
        $id->delete();
        return redirect('/');
    }
}
