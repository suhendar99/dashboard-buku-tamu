<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $guarded = [];

    public function aktivitas()
    {
        return $this->belongsTo('App\Models\AktivitasPengunjung');
    }
}
