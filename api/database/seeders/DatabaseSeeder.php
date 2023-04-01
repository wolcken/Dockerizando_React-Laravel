<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CelularePersona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use \App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  En esta parte se llena las tablas que no tienen relaciones y tienen datos simples
        //  los datos de las tablas se encuentran en seeders
        $this->call(CategoriasSeeder::class);
        $this->call(CursosSeeder::class);
        $this->call(DiasSeeder::class);
        $this->call(MateriasSeeder::class);
        $this->call(NivelesSeeder::class);
        $this->call(ParalelosSeeder::class);
        $this->call(PeriodosSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(MensajesSeeder::class);
        $this->call(TurnosSeeder::class);
        $this->call(ValidacionesSeeder::class);
        //  en esta parte se llenan usando factorym pero algunos no se pudieron por las llaves foraneas
        // ya que las llaves foraneas son únicas por lo que se crearon los do while que estan abajo
        //\App\Models\User::factory(125)->create();
        \App\Models\Persona::factory(3005)->create();
        \App\Models\Direccione::factory(1570)->create();
        \App\Models\Celulare::factory(1570)->create();
        \App\Models\Colegio::factory(5)->create();
        $i=1;
        do{
            CelularePersona::factory()->create([
                'celulare_id' => fake()->numberBetween(6, 1570),
                'persona_id' => $i,
            ]);
            \App\Models\DireccionePersona::factory()->create([
                'direccione_id' => fake()->numberBetween(6,1570),
                'persona_id' => $i,
            ]);
            $i=$i+1;
        }while($i<3006);
        $i=1;
        do{
            \App\Models\CelulareColegio::factory()->create([
                'celulare_id' => $i,
                'colegio_id' => $i,
            ]);
            \App\Models\ColegioDireccione::factory()->create([
                'colegio_id' => $i,
                'direccione_id'=> $i,
            ]);
            $i=$i+1;
        }while($i<6);
        $i=1;
        $j=1;
        do{
            \App\Models\User::factory()->create([
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('1234'),
                'role_id' => fake()->randomElement([1,2,3,4]),
                'persona_id' => $i,
                'colegio_id' => $j,
                'actividad' => true,
                'remember_token' => Str::random(10),
            ]);
            if($i % 25 ==0){
                $j=$j+1;
            }
            $i=$i+1;
        }while($i<126);
        $this->call(MateriausersSeeder::class);
        $i=1;
        $j=1;
        $k=1;
        $l=1;
        $c=1;
        do{
            \App\Models\Cursoparalelo::factory()->create([
                'curso_id' => $i,
                'paralelo_id' => $j,
                'nivele_id' => $k,
                'colegio_id'=> $l,
            ]);
            if ($j==1){
                $j=2;
            }else{
                $i=$i+1;
                $j=1;
            }
            if($i == 7){
                $i=1;
                $j=1;
                $k=2;
            }
            if($c == 24){
                $k=1;
                $l=2;
            }
            $c=$c+1;
        }while($c<49);
        $i=126;
        $j=1;
        $k=1;
        do{
            \App\Models\Estudiante::factory()->create([
                'inscripcion' => true,
                'persona_id' => $i,
                'cursoparalelo_id' => $k,
            ]);
            if ($j % 30 ==0){
                $k=$k+1;
            }
            $j=$j+1;
            $i=$i+1;
        }while($i<1566);
        $i=1566;
        do{
            \App\Models\Tutore::factory()->create([
                'persona_id' => $i,

            ]);
            $i=$i+1;
        }while($i<3006);
        $j=1;
        do{
            \App\Models\EstudianteTutore::factory()->create([
                'tutore_id' => $j,
                'estudiante_id' => $j,
            ]);
            $j=$j+1;
        }while($j<1441);
        \App\Models\Horario::factory(1000)->create();
        \App\Models\Asistencia::factory(1000)->create();
        \App\Models\AsistenciaEstudiante::factory(1000)->create();

    }
}
