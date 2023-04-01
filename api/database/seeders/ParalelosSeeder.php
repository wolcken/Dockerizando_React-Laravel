<?php

namespace Database\Seeders;

use App\Models\Paralelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParalelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('paralelos')->insert([['name' => 'A'],
        ['name' => 'B'],
        ['name' => 'C'],
        ['name' => 'D'],
        ['name' => 'E'],
        ['name' => 'F'],
        ['name' => 'G'],
        ['name' => 'H']]);*/
        $paralelo = new Paralelo();
        $paralelo->name = "A";
        $paralelo->save();
        $paralelo1 = new Paralelo();
        $paralelo1->name = "B";
        $paralelo1->save();
        $paralelo2 = new Paralelo();
        $paralelo2->name = "C";
        $paralelo2->save();
        $paralelo3 = new Paralelo();
        $paralelo3->name = "D";
        $paralelo3->save();
        $paralelo4 = new Paralelo();
        $paralelo4->name = "E";
        $paralelo4->save();
        $paralelo5 = new Paralelo();
        $paralelo5->name = "F";
        $paralelo5->save();
        $paralelo6 = new Paralelo();
        $paralelo6->name = "G";
        $paralelo6->save();
        $paralelo7 = new Paralelo();
        $paralelo7->name = "H";
        $paralelo7->save();

    }
}
