<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontpage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'frontpage';
    protected $primaryKey = 'id';
}
