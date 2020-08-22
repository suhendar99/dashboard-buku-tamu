<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Pengunjung extends Model
{
    use LogsActivity;

    protected $guarded = [];


    public function aktivitas()
    {
        return $this->hasMany('App\Models\AktivitasPengunjung','id_pengunjung','id');
    }

    public function antri()
    {
        return $this->hasMany('App\Models\antri');
    }
}
