<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('roles')->insert([['role' => 'admin', 'sueldo' => 0],
        ['role' => 'director', 'sueldo' => 5000],
        ['role' => 'docente', 'sueldo' => 4000],
        ['role' => 'secretaria', 'sueldo' => 3000],
        ['role' => 'alumno', 'sueldo' => 0]]);*/
        $role = new Role();
        $role->role = "administrador";
        $role->sueldo = 0;
        $role->save();
        $role1 = new Role();
        $role1->role = "director";
        $role1->sueldo = 5000;
        $role1->save();
        $role2 = new Role();
        $role2->role = "docente";
        $role2->sueldo = 4000;
        $role2->save();
        $role3 = new Role();
        $role3->role = "secretaria";
        $role3->sueldo = 3000;
        $role3->save();
        $role4 = new Role();
        $role4->role = "alumno";
        $role4->sueldo = 0;
        $role4->save();

    }
}
