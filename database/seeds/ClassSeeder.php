<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class')
        ->insert([
            'name' => 'Helsinki',
            'major' => 'MIA',
            'grade' => 10,
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now'),
            'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'London',
        'major' => 'MIA',
        'grade' => 10,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Berlin',
        'major' => 'IIS',
        'grade' => 10,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Brussel',
        'major' => 'IIS',
        'grade' => 10,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Ottawa',
        'major' => 'IIS',
        'grade' => 10,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'California',
        'major' => 'MIA',
        'grade' => 11,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Boston',
        'major' => 'MIA',
        'grade' => 11,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'New York',
        'major' => 'IIS',
        'grade' => 11,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Athena',
        'major' => 'IIS',
        'grade' => 11,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Istanbul',
        'major' => 'IIS',
        'grade' => 11,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Sydney',
        'major' => 'MIA',
        'grade' => 12,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Seoul',
        'major' => 'MIA',
        'grade' => 12,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Tokyo',
        'major' => 'IIS',
        'grade' => 12,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Florida',
        'major' => 'IIS',
        'grade' => 12,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);

    DB::table('class')
    ->insert([
        'name' => 'Melbourne',
        'major' => 'IIS',
        'grade' => 12,
        'create_at' => new \DateTime('now'),
        'update_at' => new \DateTime('now'),
        'active' => 'Y'
    ]);
    }
}
