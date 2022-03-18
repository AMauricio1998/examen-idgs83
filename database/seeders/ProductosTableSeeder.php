<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::truncate();

        $tiendas = Tienda::all()->where("id", "<=", 15);
        foreach($tiendas as $key => $tienda) {
            for($i = 1; $i <=($key+1); $i++) {
                Producto::create([
                    'nombre' => "Este es el titulo del contenido $tienda->title",
                    'clave' => "Este es el cuerpo del comentario",
                    'imagen' => "Este es el cuerpo del comentario",
                    'precio' => "Este es el cuerpo del comentario",
                    'descuento' => "Este es el cuerpo del comentario",
                    'id_tienda'  => $tienda->id,
                ]);
            }
        }
    }
}
