<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ReportDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();

        $data = DB::table('m_student_class')
                ->select('student_id', 'class_id','raport_id')
                ->get();
        foreach ($data as $d) {
            $m_mp_class = DB::table('m_mp_class')
                            ->select('course_id')
                            ->where('class_id',$d->class_id)
                            ->get();
            foreach($m_mp_class as $mp){
                DB::table('raport_detail')
                ->insert([
                    'course_id' => $mp->course_id,
                    'raport_id' => $d->raport_id,
                    'score' => (double) $faker->numberBetween($min = 60, $max = 100),
                    'practicume' => (double) $faker->numberBetween($min = 60, $max = 100),
                    'description' => $faker->realText($maxNbChars = 200, $indexSize = 1)
                ]);
            }

        }

    }
}
