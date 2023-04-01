<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('periodos')->insert([['name' => 'primero'],
        ['name' => 'segundo'],
        ['name' => 'tercero'],
        ['name' => 'cuarto']]);*/
        $periodo = new Periodo();
        $periodo->name = "primero";
        $periodo->save();
        $periodo1 = new Periodo();
        $periodo1->name = "segundo";
        $periodo1->save();
        $periodo2 = new Periodo();
        $periodo2->name = "tercero";
        $periodo2->save();
        $periodo3 = new Periodo();
        $periodo3->name = "cuarto";
        $periodo3->save();

    }
}
