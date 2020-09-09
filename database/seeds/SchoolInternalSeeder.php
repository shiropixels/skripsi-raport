<?php

use Illuminate\Database\Seeder;

class SchoolInternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_internal')
        ->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$SQbX0bZBR6/QgYgEQDaOq.n2AN/FUQifnTiwlSghJPYP2twizRek.',
            'phone' => '0811111111111',
            'profile_picture'=>'',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y',
        ]);

        DB::table('school_internal')
        ->insert([
            'role_id' => 2,
            'name' => 'WaliKelas 1',
            'email' => 'wk1@gmail.com',
            'password' => '$2y$10$SQbX0bZBR6/QgYgEQDaOq.n2AN/FUQifnTiwlSghJPYP2twizRek.',
            'phone' => '082222222222',
            'profile_picture'=>'',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y',
        ]);

        DB::table('school_internal')
        ->insert([
            'role_id' => 2,
            'name' => 'WaliKelas 2',
            'email' => 'wk2@gmail.com',
            'password' => '$2y$10$SQbX0bZBR6/QgYgEQDaOq.n2AN/FUQifnTiwlSghJPYP2twizRek.',
            'phone' => '083333333333',
            'profile_picture'=>'',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y',
        ]);
       
    }
}
