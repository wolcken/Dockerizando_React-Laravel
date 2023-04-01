<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('turnos')->insert([['name' => 'mañana'],
        ['name' => 'tarde'],
        ['name' => 'noche']]);*/
        $turno = new Turno();
        $turno->name = "mañana";
        $turno->save();
        $turno1 = new Turno();
        $turno1->name = "tarde";
        $turno1->save();
        $turno2 = new Turno();
        $turno2->name = "noche";
        $turno2->save();
    }
}
