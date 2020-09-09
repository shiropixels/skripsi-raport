<?php

use Illuminate\Database\Seeder;

class MSiClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_si_class')
        ->insert([
            'class_id' => 1,
            'school_internal_id' => 2,
            'start_year' => '2020',
            'end_year' => '2021',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y',
        ]);
        DB::table('m_si_class')
        ->insert([
            'class_id' => 6,
            'school_internal_id' => 3,
            'start_year' => '2020',
            'end_year' => '2021',
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y',
        ]);
    }
}
