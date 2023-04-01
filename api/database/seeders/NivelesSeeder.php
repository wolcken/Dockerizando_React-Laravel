<?php

namespace Database\Seeders;

use App\Models\Nivele;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('niveles')->insert([['name' => 'primaria'],
        ['name' => 'secundaria']]);*/
        $nivel = new Nivele();
        $nivel->name = "primaria";
        $nivel->save();
        $nivel1 = new Nivele();
        $nivel1->name = "secundaria";
        $nivel1->save();
    }
}
