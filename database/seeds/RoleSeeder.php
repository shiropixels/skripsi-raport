<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('role')
        ->insert([
            'name' => 'Admin',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
        ]);
        DB::table('role')
        ->insert([
            'name' => 'WaliKelas',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
        ]);

    }
}
