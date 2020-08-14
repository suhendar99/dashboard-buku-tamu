<?php

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create([
            'nama' => 'Pegawai 1',
            'nip' => '12332341',
            'bagian' => 'Perakit',
            'status' => 'Aktif'
        ]);
    }
}
