<?php

use Illuminate\Database\Seeder;
use App\Models\AktivitasPengunjung;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AktivitasPengunjung::create([
            'jadwal_kunjungan' => '2020-01-01'
        ]);
    }
}
