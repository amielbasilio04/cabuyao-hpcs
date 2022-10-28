<?php

namespace Database\Seeders;

use App\Models\Admin\Resident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
         
        $this->call([
            BarangaySeeder::class,
            ResidentSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            HealthIssueSeeder::class,
            FamilyHistorySeeder::class,
            HealthProfileSeeder::class
        ]);

    }
}
