<?php

namespace Database\Seeders;

use App\Models\Admin\Barangay;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangays = array(
            ['name' => 'Baclaran','lat' => '14.241661797825051','long' => '121.16398559595565', 'created_at' => now()],
            ['name' => 'Banay–Banay ','lat' => '14.254556438439517','long' => '121.12935304254324', 'created_at' => now()],
            ['name' => 'Banlic','lat' => '14.232260892580623','long' => '121.14091877097702', 'created_at' => now()],
            ['name' => 'Bigaa','lat' => '14.288608911507897','long' => '121.12688531925612', 'created_at' => now()],
            ['name' => 'Butong','lat' => '14.286519101329626','long' => '121.13286133796504', 'created_at' => now()],
            ['name' => 'Casile','lat' => '14.2091796','long' => '121.0365678', 'created_at' => now()],
            ['name' => 'Diezmo','lat' => '14.246142545710507','long' => '121.10773413719741', 'created_at' => now()],
            ['name' => 'Gulod','lat' => '14.256386430710462','long' => '121.16231196709754', 'created_at' => now()],
			
            ['name' => 'Mamatid','lat' => '14.238427737016316','long' => '121.15155101868659', 'created_at' => now()],
	    ['name' => 'Marinig','lat' => '14.270880574570494','long' => '121.1574731902566', 'created_at' => now()],
            ['name' => 'Niugan','lat' => '14.2620331','long' => '121.1236775', 'created_at' => now()],
            ['name' => 'Pittland','lat' => '14.2214965','long' => '121.0578443', 'created_at' => now()],
            ['name' => 'Pulo','lat' => '14.2438978','long' => '121.1273904', 'created_at' => now()],
            ['name' => 'Sala','lat' => '14.272311285832346','long' => '121.12211366639997', 'created_at' => now()],
            ['name' => 'San Isidro','lat' => '14.238334104767633','long' => '121.13478175675941', 'created_at' => now()],
            ['name' => 'Pob Uno','lat' => '14.280329744522147','long' => '121.12396659062634', 'created_at' => now()],
            ['name' => 'Pob Dos','lat' => '14.27852098507201','long' => '121.12636105482163', 'created_at' => now()],
            ['name' => 'Pob Tres','lat' => '14.275310757021929','long' => '121.1236073109303', 'created_at' => now()],
        );

        Barangay::insert($barangays);
    }
}
