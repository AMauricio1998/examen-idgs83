<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $fillable = [
        'nombre_clave',
        'precio',
        'cantidad',
        'total',
        'subtotal',
        'descuento',
        'id_tienda',
        'id_empleado',
        'id_producto',
    ];

    public function tienda() {
        return $this->belongsTo(Tienda::class, 'id_tienda');
    }

    public function empleado() {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function producto() {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
