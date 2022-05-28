<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = "galeris";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'image', 'caption_gambar'
    ];
}
