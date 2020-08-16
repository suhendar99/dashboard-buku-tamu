<?php

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        Pegawai::create([
            'nama' => 'Pegawai 1',
            'nip' => '12332341',
            'bagian' => 'Perakit',
            'status' => 'Aktif',
            'jk' => 'L',
            'tanggal' => $now,
        ]);
    }
}
