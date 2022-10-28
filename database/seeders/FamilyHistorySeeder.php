<?php

namespace Database\Seeders;

use App\Models\Admin\FamilyHistory;
use Illuminate\Database\Seeder;

class FamilyHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $family_histories = array(
            ['type' => 'Allergies', 'created_at' => now()],
            ['type' => 'Arthritis', 'created_at' => now()],
            ['type' => 'Diabetes', 'created_at' => now()],
            ['type' => 'Epilepsy', 'created_at' => now()],
            ['type' => 'Gout', 'created_at' => now()],
            ['type' => 'Glaucoma', 'created_at' => now()],
            ['type' => 'Heart Attack', 'created_at' => now()],
            ['type' => 'Hypertension', 'created_at' => now()],
            ['type' => 'Kidney Disease', 'created_at' => now()],
            ['type' => 'Mental Illness', 'created_at' => now()],
            ['type' => 'Migraine', 'created_at' => now()],
            ['type' => 'Tubercolosis', 'created_at' => now()],
        );

        FamilyHistory::insert($family_histories);
    }
}
