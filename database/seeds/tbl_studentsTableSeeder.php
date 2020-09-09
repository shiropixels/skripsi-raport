<?php

use Illuminate\Database\Seeder;
class studentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            'nama' => 'dina',
    		'nis' => '20015678093',
    		'email' => 'dina52424@gmail.com',
    		'password' => Hash::make('Alex123'),
    		'phone' => '08128319134',
    		'class_id' =>'2',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now')


    ]);
    }
}
