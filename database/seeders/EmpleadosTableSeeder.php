<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Tienda;
use Illuminate\Database\Seeder;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::truncate();

        $tiendas = Tienda::all()->where("id", "<=", 15);
        foreach($tiendas as $key => $tienda) {
            for($i = 1; $i <=($key+1); $i++) {
                Empleado::create([
                    'nombre' => "Tienda: $tienda->nombre",
                    'imagen' => "Este es la imagen",
                    'id_tienda'  => $tienda->id,
                ]);
            }
        }
    }
}
