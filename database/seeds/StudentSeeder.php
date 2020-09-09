<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {
            DB::table('student')->insert([
                'code' => (string) $faker->numberBetween($min = 1000000, $max = 9999999),
                'name' => $faker->unique()->firstName(),
                'password' => Hash::make('admin12345'),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'profile_picture' => "",
                'active' => 'Y',
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now')
            ]);
        }
    }
}
