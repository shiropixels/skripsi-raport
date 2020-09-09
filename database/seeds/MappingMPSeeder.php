<?php

use Illuminate\Database\Seeder;

class MappingMPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_mp_class')
        ->insert([
            'class_id' => 1,
            'course_id' => 1,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 1,
            'course_id' => 2,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 1,
            'course_id' => 3,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 1,
            'course_id' => 4,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 1,
            'course_id' => 5,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 6,
            'course_id' => 1,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 6,
            'course_id' => 2,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 6,
            'course_id' => 3,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 6,
            'course_id' => 4,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);

        DB::table('m_mp_class')
        ->insert([
            'class_id' => 6,
            'course_id' => 7,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
        ]);
    }
}
