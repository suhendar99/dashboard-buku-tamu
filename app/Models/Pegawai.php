<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Pegawai extends Model
{
    use LogsActivity;
    protected $guarded = [];
}
