<?php

namespace Database\Seeders;

use App\Models\Admin\HealthProfile;
use Illuminate\Database\Seeder;

class HealthProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $health_profiles = array(

            ['resident_id' => 1 , 'health_issue_id' => 1, 'family_history_id' => 1, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 2 , 'health_issue_id' => 2, 'family_history_id' => 2, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 3 , 'health_issue_id' => 4, 'family_history_id' => 4, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],
            
            ['resident_id' => 4 , 'health_issue_id' => 3, 'family_history_id' => 4, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 5 , 'health_issue_id' => 3, 'family_history_id' => 4, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 6 , 'health_issue_id' => 4, 'family_history_id' => 5, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 7 , 'health_issue_id' => 5, 'family_history_id' => 6, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 8 , 'health_issue_id' => 6, 'family_history_id' => 7, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 9 , 'health_issue_id' => 7, 'family_history_id' => 8, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 10,'health_issue_id' => 8, 'family_history_id' => 9, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 11,'health_issue_id' => 9, 'family_history_id' => 10, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 12,'health_issue_id' => 10,'family_history_id' => 11, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 13,'health_issue_id' => 11, 'family_history_id' => 12, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],

            ['resident_id' => 14 ,'health_issue_id' => 12, 'family_history_id' => 12, 'guardian' => 'Sample guardian', 'contact' => '09659312003', 'relationship' => 'mother', 'address'=>'sample address', 'created_at' => now()],
        );

        HealthProfile::insert($health_profiles);
    }
}
