<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('cursos')->insert([['name' => 'primero'],
        ['name' => 'segundo'],
        ['name' => 'tercero'],
        ['name' => 'cuarto'],
        ['name' => 'quinto'],
        ['name' => 'sexto'],
        ['name' => 'séptimo'],
        ['name' => 'octavo']]);*/
        $curso = new Curso();
        $curso->name = "primero";
        $curso->save();
        $curso1 = new Curso();
        $curso1->name = "segundo";
        $curso1->save();
        $curso2 = new Curso();
        $curso2->name = "tercero";
        $curso2->save();
        $curso3 = new Curso();
        $curso3->name = "cuarto";
        $curso3->save();
        $curso4 = new Curso();
        $curso4->name = "quinto";
        $curso4->save();
        $curso5 = new Curso();
        $curso5->name = "sexto";
        $curso5->save();
        $curso6 = new Curso();
        $curso6->name = "séptimo";
        $curso6->save();
        $curso7 = new Curso();
        $curso7->name = "octavo";
        $curso7->save();

    }
}
