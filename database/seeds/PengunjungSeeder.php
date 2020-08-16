<?php

use Illuminate\Database\Seeder;
use App\Models\Pengunjung;
use Carbon\Carbon;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        Pengunjung::create([
            'nama' => 'Pengunjung 1',
            'nik' => '123123',
            'instansi' => 'PT A',
            'telp' => '08299183782',
            'tujuan' => 'PT B',
            'kunjungan' => 'Idustri',
            'jk' => 'L',
            'tanggal' => $now,
        ]);
    }
}
