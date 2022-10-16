<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisVaksin extends Model
{
    use HasFactory;
    protected $table = 'jenis_vaksin';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function vaksinisasi()
    {
        return $this->belongsTo(Vaksinisasi::class);
    }
}
