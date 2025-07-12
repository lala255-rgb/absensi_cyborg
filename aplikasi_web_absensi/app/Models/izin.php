<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class izin extends Model
{
    use HasFactory;
    protected $fillable = [
            'id_kategori_izin',
            'id_user',
            'deskripsi_izin',
            'status',
            'surat_keterangan_sakit',
            'created_by',       
    ];
}
