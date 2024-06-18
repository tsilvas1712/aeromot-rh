<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Staff;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $staff = Staff::all()->random(1);
        $user = User::all()->random(1);




        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);



        Feedback::factory(100)->create(
            [
                'staf_id' => $staff[0]->id,
                'user_id' => $user[0]->id,
            ]
        );
    }
}
