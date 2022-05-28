<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;
    protected $table = "berandas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'isi_beranda', 'deskripsi_tambahan', 'image', 'caption_gambar'
    ];
}
