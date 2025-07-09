<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;
    protected $fillable = [
            'id_user',
            'role_user',
            'tanggal_dan_waktu',
            'jurusan' ,
            'foto_absensi',
            'status' ,
            'keterangan',
            'created_by', 
    ];
}
