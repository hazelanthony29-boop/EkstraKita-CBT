<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';
    protected $guarded = [];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'ekskul_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'ekskul_id');
    }
}
