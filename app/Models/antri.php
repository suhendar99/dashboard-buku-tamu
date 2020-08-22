<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class antri extends Model
{

    protected $guarded = [];

    public function pengunjung()
    {
        return $this->belongsTo('App\Models\Pengunjung');
    }
}
