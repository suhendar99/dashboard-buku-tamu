<?php

use Illuminate\Database\Seeder;
use App\Models\SetApp;

class SetappSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetApp::create([
            'name_tab' => 'Makerindo',
            'name_app' => 'Makerindo',
            'icon_app' => 'fas fa-user',
            'copyright' => 'Makerindo',
        ]);
    }
}
