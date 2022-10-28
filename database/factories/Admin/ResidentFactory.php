<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resident::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
	$gender = $this->faker->randomElement(['Male', 'Female']);
        return [
            'fname' => $this->faker->firstName($gender),
            'mname' => $this->faker->lastName,
            'lname' => $this->faker->lastName,
            'suffix' => $this->faker->firstName,
            'gender' => $gender,
            'birthdate' => $this->faker->date,
            'address' => $this->faker->address,
            'barangay_id' => Barangay::all()->random()->id,
            'contact' => $this->faker->bothify('09#########'),
            'email' => preg_replace('/@example\..*/', '@gmail.com', $this->faker->unique()->safeEmail)
        ];
    }

    public function getGender()
    {
       return $this->faker->randomElements($array = array('male','female'));
    }

}
