<?php

namespace Database\Seeders;

use App\Models\Tienda;
use Illuminate\Database\Seeder;

class ProductosTiendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tienda::truncate();
        for($i = 1; $i<=20; $i++){
            Tienda::create([
                'nombre' => "tienda $i",
                'descuento' => "tienda $i",
                'foto' => "http://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2019/05/que-significa-logo-del-oxxo.jpg",
            ]);
        }
    }
}
