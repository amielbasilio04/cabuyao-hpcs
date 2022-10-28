<?php

namespace Database\Seeders;

use App\Models\Admin\Resident;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // generate city admin
         Resident::create(['fname' => 'City',
         'mname' => 'Lee',
         'lname' => 'Admin',
         'suffix' => 'mr',
         'gender' => 'Male',
         'birthdate' => '1998-07-10',
         'address' => 'City of Cabuyao',
         'barangay_id' => 1,
         'contact' => '09659312003',
         'email' => 't4@gmail.com'
        ]);

         // generate brgy admin
         Resident::create(['fname' => 'Brgy',
         'mname' => 'Lee',
         'lname' => 'Admin',
         'suffix' => 'mr',
         'gender' => 'Male',
         'birthdate' => '1998-07-10',
         'address' => 'City of Cabuyao',
         'barangay_id' => 2,
         'contact' => '09659312003',
         'email' => 't2@gmail.com'
        ]);

        Resident::factory(30)->create();
    }
}
