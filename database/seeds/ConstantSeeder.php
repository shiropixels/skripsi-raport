<?php

use Illuminate\Database\Seeder;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('constant')->insert([
            'code' => "KEPALA_SEKOLAH",
            'name' => "Kepala Sekolah",
            'value' => "Jupri S.S., S. Sos. I.",
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now')
        ]);
        DB::table('constant')->insert([
            'code' => "STAMPLE",
            'name' => "Stample Sekolah",
            'value' => "storage/schoolInternalSignature/stamp.png",
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now')
        ]);
        DB::table('constant')->insert([
            'code' => "TTD",
            'name' => "Tanda Tangan Kepala Sekolah",
            'value' => "storage/schoolInternalSignature/signature.png",
            'create_at' => new \DateTime('now'),
            'update_at' => new \DateTime('now')
        ]);
    
    }
}
