<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graduate extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=[
        'nama',
        'deskripsi',
        'foto',
        'is_lulus',
        'nama_lengkap',
        'jurusan',
        'gelar',
    ];
}
