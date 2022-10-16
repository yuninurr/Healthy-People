<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksinisasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'vaksinisasi';
    protected $primaryKey = 'id';
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function lokasi_vaksin()
    {
        return $this->belongsTo(LokasiVaksin::class);
    }
    public function jenis_vaksin()
    {
        return $this->belongsTo(JenisVaksin::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
