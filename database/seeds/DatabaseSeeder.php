<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClassSeeder::class);
        $this->call(MataPelajaranSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SchoolInternalSeeder::class);
        $this->call(MSiClassSeeder::class);
        $this->call(MappingMPSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(StudentMappingSeeder::class);
        $this->call(ReportDetailSeeder::class);
        $this->call(ConstantSeeder::class);

    }
}
