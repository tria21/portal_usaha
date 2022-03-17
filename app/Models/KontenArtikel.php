<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenArtikel extends Model
{
    use HasFactory;
    protected $table = "konten_artikels";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'judul', 'gambar', 'caption_gambar', 'isi_artikel'
    ];
}
