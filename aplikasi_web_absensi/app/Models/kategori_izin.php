<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_izin extends Model
{
    use HasFactory;
    protected $fillable = [
            'nama_kategori',
            'keterangan',
            'created_by',       
    ];

}
