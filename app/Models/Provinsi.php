<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'provinsi';
    protected $primaryKey = 'id';

    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }
    public function lokasi_vaksin()
    {
        return $this->hasMany(LokasiVaksin::class);
    }
    public function jenis_vaksin()
    {
        return $this->hasMany(JenisVaksin::class);
    }
    public function vaksinisasi()
    {
        return $this->hasMany(Vaksinisasi::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
