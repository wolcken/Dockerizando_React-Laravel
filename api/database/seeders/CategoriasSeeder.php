<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('categorias')->insert([['name' => 'público'],
        ['name' => 'privado'],
        ['name' => 'convenio']]);*/
        $categoria = new Categoria();
        $categoria->name = "público";
        $categoria->save();
        $categoria1 = new Categoria();
        $categoria1->name = "privado";
        $categoria1->save();
        $categoria2 = new Categoria();
        $categoria2->name = "convenio";
        $categoria2->save();

    }
}
