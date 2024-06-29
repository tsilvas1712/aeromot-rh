<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /*
        $users = User::withoutRole(['Admin', 'Gestor'])->get();
        foreach ($users as $user) {
            $user->assignRole('Profissional');
        }

        exit();*/

        User::factory(10)->create();

        $staffs = User::role('Gestor')->get();
        $users = User::role('Profissional')->get();

        $user = $users->random(1);
        $staff = $staffs->random(1);

        Feedback::factory(1)->create(
            [
                'staf_id' => $staff[0]->id,
                'user_id' => $user[0]->id,
                'execution_rating' => '5',
                'tec_know_rating' => '5',
                'behavioral_respect_rating' => '5',
                'behavioral_proactivity_rating' => '5',
                'behavioral_excellence_rating' => '5',
                'behavioral_innovation_rating' => '5',
                'behavioral_flexibility_rating' => '5',
                'behavioral_rules_rating' => '5',
                'organization_planning_rating' => '5',
                'organization_planning_rating' => '5',
                'organization_organization_rating' => '5',
                'organization_priority_rating' => '5',
                'organization_deadlines_rating' => '5',
            ]
        );
    }
}
