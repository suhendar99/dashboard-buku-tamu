<?php

use Illuminate\Database\Seeder;
use App\Models\Pengunjung;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengunjung::create([
            'nama' => 'Pengunjung 1',
            'nik' => '123123',
            'instansi' => 'PT A',
            'telp' => '08299183782',
            'tujuan' => 'PT B',
            'kunjungan' => 'Idustri',
        ]);
    }
}
