<?php

namespace Database\Seeders;

use App\Models\Validacione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValidacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('validaciones')->insert([['name' => 'presente'],
        ['name' => 'retraso'],
        ['name' => 'falta'],
        ['name' => 'reunión']]);*/
        $validar = new Validacione();
        $validar->name = "presente";
        $validar->save();
        $validar1 = new Validacione();
        $validar1->name = "retraso";
        $validar1->save();
        $validar2 = new Validacione();
        $validar2->name = "falta";
        $validar2->save();
        $validar3 = new Validacione();
        $validar3->name = "reunión";
        $validar3->save();
    }
}
