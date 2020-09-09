<?php

use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')
            ->insert([
                "name" => "Matematika",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Bahasa Indonesia",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Bahasa Inggris",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Fisika",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Biologi",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Kimia",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Sosiologi",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Ekonomi",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Sejarah",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        
        DB::table('course')
            ->insert([
                "name" => "Ini Data Dummy kan?",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Komunisme :)",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Pendidikan Kewarganegaraan",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Pendidikan Lingkungan Hidup",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);

        DB::table('course')
            ->insert([
                "name" => "Pendidikan Jasmani dan Kesehatan",
                "min_grade" => 75,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now'),
                "active" => "Y"
            ]);
    }
}
