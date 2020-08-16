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
        $this->call(UserSeeder::class);
        $this->call(AktivitasSeeder::class);
        $this->call(PengunjungSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(SetappSeeder::class);
        $this->call(SetLaporanSeeder::class);
    }
}
