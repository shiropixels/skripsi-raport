<?php

use Illuminate\Database\Seeder;
use \Cake\Auth\DefaultPasswordHasher;
class school_internalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
    	DB::table('school_internal')->insert(['nama' => 'Adi',
    		'email' => 'Adi5249@gmail.com',
    		'phone' => '081286949930',
            'password' => Hash::make('Adi123'),
            'profile_picture'=>'',
            'role_id' =>'1',
            'class_id' => null,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now')

    ]);

        
    }
}
