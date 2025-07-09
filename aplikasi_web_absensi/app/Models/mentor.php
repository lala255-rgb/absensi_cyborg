<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mentor extends Model

{
    protected $table = "mentor";
   
    protected$fillable =[
        'nama',
        'nohp',
        'tanggal_dan_waktu',
        'jenis_kelamin',
        'alamat',
        'foto',
        'keterangan',
        'created_by'
    ];
}
