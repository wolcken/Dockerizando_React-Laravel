<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('dias')->insert([['name' => 'lunes'],
        ['name' => 'martes'],
        ['name' => 'miercoles'],
        ['name' => 'jueves'],
        ['name' => 'viernes'],
        ['name' => 'sábado']]);*/
        $dia = new Dia();
        $dia->name = "lunes";
        $dia->save();
        $dia1 = new Dia();
        $dia1->name = "martes";
        $dia1->save();
        $dia2 = new Dia();
        $dia2->name = "miercoles";
        $dia2->save();
        $dia3 = new Dia();
        $dia3->name = "jueves";
        $dia3->save();
        $dia4 = new Dia();
        $dia4->name = "viernes";
        $dia4->save();
        $dia5 = new Dia();
        $dia5->name = "sábado";
        $dia5->save();

    }
}
