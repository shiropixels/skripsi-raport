<?php

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function getSemesterByRapotId($number){
        if($number - 200 >= 1) return 1;
        if($number - 100 >= 1) return 2;
        
        return 1;
    }

    public function run()
    {

        for($i = 1; $i<= 300; $i++){
            DB::table('raport')
            ->insert([
                'semester' => $this->getSemesterByRapotId($i),
                'absent' => ($i % 2 == 0) ? 2: 1,
                'create_at' => new \DateTime('now'),
                'update_at' => new \DateTime('now')
            ]);
        }

    }
}
