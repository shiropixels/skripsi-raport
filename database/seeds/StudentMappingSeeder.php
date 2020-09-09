<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function getGrade10($id){
        $faker = Faker::create();

        $course = 0;

        if($id % 4 == 0){
           $course = $faker->numberBetween($min = 1, $max = 2);
        }else{
            $course = $faker->numberBetween($min = 3, $max = 5);
        }

        return $course;
    }

    private function getGrade11($id){
        $faker = Faker::create();

        $course = 0;

        if($id % 4 == 0){
           $course = $faker->numberBetween($min = 6, $max = 7);
        }else{
            $course = $faker->numberBetween($min = 8, $max = 10);
        }

        return $course;
    }

    public function run()
    {

        for ($i = 1; $i <= 100; $i++) {
            DB::table('m_student_class')->insert([
                'student_id' => $i,
                'class_id' => $this->getGrade11($i),
                'raport_id' => $i+200,
                'start_year' => '2020',
                'end_year' => '2021',
                'active' => 'Y',
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now')
            ]);

            $course10 = $this->getGrade10($i);

            DB::table('m_student_class')->insert([
                'student_id' => $i,
                'class_id' => $course10,
                'raport_id' => $i+100,
                'start_year' => '2019',
                'end_year' => '2020',
                'active' => 'N',
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now')
            ]);

            DB::table('m_student_class')->insert([
                'student_id' => $i,
                'class_id' => $course10,
                'raport_id' => $i,
                'start_year' => '2019',
                'end_year' => '2020',
                'active' => 'N',
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now')
            ]);
        }
    }
}
