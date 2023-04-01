<?php

namespace Database\Seeders;

use App\Models\Materiauser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriausersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materia = new Materiauser();
        $materia->user_id = 3;
        $materia->materia_id = 1;
        $materia->nivele_id = 2;
        $materia->save();
        $materia1 = new Materiauser();
        $materia1->user_id = 3;
        $materia1->materia_id = 2;
        $materia1->nivele_id = 2;
        $materia1->save();
        $materia2 = new Materiauser();
        $materia2->user_id = 4;
        $materia2->materia_id = 3;
        $materia2->nivele_id = 2;
        $materia2->save();
        $materia3 = new Materiauser();
        $materia3->user_id = 5;
        $materia3->materia_id = 4;
        $materia3->nivele_id = 2;
        $materia3->save();
        $materia4 = new Materiauser();
        $materia4->user_id = 6;
        $materia4->materia_id = 5;
        $materia4->nivele_id = 2;
        $materia4->save();
        $materia5 = new Materiauser();
        $materia5->user_id = 7;
        $materia5->materia_id = 6;
        $materia5->nivele_id = 2;
        $materia5->save();
        $materia6 = new Materiauser();
        $materia6->user_id = 8;
        $materia6->materia_id = 7;
        $materia6->nivele_id = 2;
        $materia6->save();
        $materia7 = new Materiauser();
        $materia7->user_id = 9;
        $materia7->materia_id = 8;
        $materia7->nivele_id = 2;
        $materia7->save();
        $materia8 = new Materiauser();
        $materia8->user_id = 10;
        $materia8->materia_id = 9;
        $materia8->nivele_id = 2;
        $materia8->save();
        $materia9 = new Materiauser();
        $materia9->user_id = 11;
        $materia9->materia_id = 10;
        $materia9->nivele_id = 2;
        $materia9->save();
        $materia10 = new Materiauser();
        $materia10->user_id = 12;
        $materia10->materia_id = 11;
        $materia10->nivele_id = 2;
        $materia10->save();
        $materia11 = new Materiauser();
        $materia11->user_id = 13;
        $materia11->materia_id = 12;
        $materia11->nivele_id = 2;
        $materia11->save();
        $materia12 = new Materiauser();
        $materia12->user_id = 14;
        $materia12->materia_id = 13;
        $materia12->nivele_id = 2;
        $materia12->save();
        $materia13 = new Materiauser();
        $materia13->user_id = 15;
        $materia13->materia_id = 14;
        $materia13->nivele_id = 2;
        $materia13->save();
        $materia14 = new Materiauser();
        $materia14->user_id = 16;
        $materia14->materia_id = 1;
        $materia14->nivele_id = 2;
        $materia14->save();
        $materia15 = new Materiauser();
        $materia15->user_id = 17;
        $materia15->materia_id = 1;
        $materia15->nivele_id = 1;
        $materia15->save();
        $materia16 = new Materiauser();
        $materia16->user_id = 18;
        $materia16->materia_id = 6;
        $materia16->nivele_id = 1;
        $materia16->save();
        $materia17 = new Materiauser();
        $materia17->user_id = 19;
        $materia17->materia_id = 7;
        $materia17->nivele_id = 1;
        $materia17->save();
        $materia18 = new Materiauser();
        $materia18->user_id = 20;
        $materia18->materia_id = 8;
        $materia18->nivele_id = 1;
        $materia18->save();
        $materia19 = new Materiauser();
        $materia19->user_id = 12;
        $materia19->materia_id = 11;
        $materia19->nivele_id = 1;
        $materia19->save();
        $materia20 = new Materiauser();
        $materia20->user_id = 21;
        $materia20->materia_id = 13;
        $materia20->nivele_id = 2;
        $materia20->save();
        $materia21 = new Materiauser();
        $materia21->user_id = 22;
        $materia21->materia_id = 14;
        $materia21->nivele_id = 2;
        $materia21->save();
    }
}
