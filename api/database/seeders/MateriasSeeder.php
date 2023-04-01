<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('materias')->insert([['name' => 'matemáticas'],
        ['name' => 'física'],
        ['name' => 'química'],
        ['name' => 'biología'],
        ['name' => 'lenguaje'],
        ['name' => 'música'],
        ['name' => 'historia'],
        ['name' => 'educación física']]);*/
        $materia = new Materia();
        $materia->name = "matemáticas";//1
        $materia->save();
        $materia1 = new Materia();
        $materia1->name = "física";//2
        $materia1->save();
        $materia2 = new Materia();
        $materia2->name = "química";//3
        $materia2->save();
        $materia3 = new Materia();
        $materia3->name = "biología";//4
        $materia3->save();
        $materia4 = new Materia();
        $materia4->name = "literatura";//5
        $materia4->save();
        $materia5 = new Materia();
        $materia5->name = "música";//6
        $materia5->save();
        $materia6 = new Materia();
        $materia6->name = "historia";//7
        $materia6->save();
        $materia7 = new Materia();
        $materia7->name = "educación física";//8
        $materia7->save();
        $materia8 = new Materia();
        $materia8->name = "geografía";//9
        $materia8->save();
        $materia9 = new Materia();
        $materia9->name = "inglés";//10
        $materia9->save();
        $materia10 = new Materia();
        $materia10->name = "religión";//11
        $materia10->save();
        $materia11 = new Materia();
        $materia11->name = "psicología";//12
        $materia11->save();
        $materia12 = new Materia();
        $materia12->name = "artes";//13
        $materia12->save();
        $materia13 = new Materia();
        $materia13->name = "filosofía";//14
        $materia13->save();
        // $materia14 = new Materia();
        // $materia14->name = "matemáticas";
        // $materia14->nivele_id=1;
        // $materia14->colegio_id=1;
        // $materia14->save();
        // $materia15 = new Materia();
        // $materia15->name = "música";
        // $materia15->nivele_id=1;
        // $materia15->colegio_id=1;
        // $materia15->save();
        // $materia16 = new Materia();
        // $materia16->name = "educación física";
        // $materia16->nivele_id=1;
        // $materia16->colegio_id=1;
        // $materia16->save();
        // $materia17 = new Materia();
        // $materia17->name = "religión";
        // $materia17->nivele_id=1;
        // $materia17->colegio_id=1;
        // $materia17->save();
        // $materia18 = new Materia();
        // $materia18->name = "inglés";
        // $materia18->nivele_id=1;
        // $materia18->colegio_id=1;
        // $materia18->save();
        // $materia19 = new Materia();
        // $materia19->name = "matemáticas";//1 - 126
        // $materia19->nivele_id=2;
        // $materia19->colegio_id=2;
        // $materia19->save();
        // $materia20 = new Materia();
        // $materia20->name = "física";//2 - 127
        // $materia20->nivele_id=2;
        // $materia20->colegio_id=2;
        // $materia20->save();
        // $materia21 = new Materia();
        // $materia21->name = "química";//3 - 128
        // $materia21->nivele_id=2;
        // $materia21->colegio_id=2;
        // $materia21->save();
        // $materia22 = new Materia();
        // $materia22->name = "biología";//4 - 129
        // $materia22->nivele_id=2;
        // $materia22->colegio_id=2;
        // $materia22->save();
        // $materia23 = new Materia();
        // $materia23->name = "literatura";//5 - 130
        // $materia23->nivele_id=2;
        // $materia23->colegio_id=2;
        // $materia23->save();
        // $materia24 = new Materia();
        // $materia24->name = "música";//6 - 131
        // $materia24->nivele_id=2;
        // $materia24->colegio_id=2;
        // $materia24->save();
        // $materia25 = new Materia();
        // $materia25->name = "historia";//7 132
        // $materia25->nivele_id=2;
        // $materia25->colegio_id=2;
        // $materia25->save();
        // $materia26 = new Materia();
        // $materia26->name = "educación física";//8 - 133
        // $materia26->nivele_id=2;
        // $materia26->colegio_id=2;
        // $materia26->save();
        // $materia27 = new Materia();
        // $materia27->name = "geografía";//9 - 134
        // $materia27->nivele_id=2;
        // $materia27->colegio_id=2;
        // $materia27->save();
        // $materia28 = new Materia();
        // $materia28->name = "inglés";//10 - 135
        // $materia28->nivele_id=2;
        // $materia28->colegio_id=2;
        // $materia28->save();
        // $materia29 = new Materia();
        // $materia29->name = "religión";//11 - 136
        // $materia29->nivele_id=2;
        // $materia29->colegio_id=2;
        // $materia29->save();
        // $materia30 = new Materia();
        // $materia30->name = "psicología";//12 -137
        // $materia30->nivele_id=2;
        // $materia30->colegio_id=2;
        // $materia30->save();
        // $materia31 = new Materia();
        // $materia31->name = "artes";//13 - 138
        // $materia31->nivele_id=2;
        // $materia31->colegio_id=2;
        // $materia31->save();
        // $materia32 = new Materia();
        // $materia32->name = "filosofía";//14 - 139
        // $materia32->nivele_id=2;
        // $materia32->colegio_id=2;
        // $materia32->save();
        // $materia33 = new Materia();
        // $materia33->name = "matemáticas";
        // $materia33->nivele_id=1;
        // $materia33->colegio_id=2;
        // $materia33->save();
        // $materia34 = new Materia();
        // $materia34->name = "música";
        // $materia34->nivele_id=1;
        // $materia34->colegio_id=2;
        // $materia34->save();
        // $materia35 = new Materia();
        // $materia35->name = "educación física";
        // $materia35->nivele_id=1;
        // $materia35->colegio_id=2;
        // $materia35->save();
        // $materia36 = new Materia();
        // $materia36->name = "religión";
        // $materia36->nivele_id=1;
        // $materia36->colegio_id=2;
        // $materia36->save();
        // $materia37 = new Materia();
        // $materia37->name = "inglés";
        // $materia37->nivele_id=1;
        // $materia37->colegio_id=2;
        // $materia37->save();
}
}
