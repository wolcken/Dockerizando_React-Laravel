<?php

namespace Database\Seeders;

use App\Models\Mensaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MensajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('mensajes')->insert([['name' => 'informativo'],
        ['name' => 'comunicativo'],
        ['name' => 'reunión urgente']]);*/
        $mensaje = new Mensaje();
        $mensaje->name = "informativo";
        $mensaje->save();
        $mensaje1 = new Mensaje();
        $mensaje1->name = "comunicativo";
        $mensaje1->save();
        $mensaje2 = new Mensaje();
        $mensaje2->name = "reunión urgente";
        $mensaje2->save();

    }
}
