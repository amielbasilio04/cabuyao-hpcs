<?php

namespace Database\Seeders;

use App\Models\Admin\HealthIssue;
use Illuminate\Database\Seeder;

class HealthIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $health_issues = array(
            ['type' => 'Dengue Fever', 'created_at' => now()],
            ['type' => 'Bronchitis', 'created_at' => now()],
            ['type' => 'Hypertension', 'created_at' => now()],
            ['type' => 'Acute Respiratory Infection', 'created_at' => now()],
            ['type' => 'HIV/AIDS', 'created_at' => now()],
            ['type' => 'Acute Watery Diarrhea', 'created_at' => now()],
            ['type' => 'Heart Attack', 'created_at' => now()],
            ['type' => 'Influenza', 'created_at' => now()],
            ['type' => 'Urinary Tract Infection', 'created_at' => now()],
            ['type' => 'TB Respiratory', 'created_at' => now()],
            ['type' => 'Migraine', 'created_at' => now()],
            ['type' => 'Chicken Pox', 'created_at' => now()],
        );

        HealthIssue::insert($health_issues);
    }
}
