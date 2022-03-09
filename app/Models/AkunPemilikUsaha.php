<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunPemilikUsaha extends Model
{
    use HasFactory;
    protected $table = "konten_berandas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'nama_pemilik', 'nama_usaha', 'jenis_usaha', 'email', 'password', 'foto',
        'alamat', 'instagram', 'facebook', 'shopee', 'tokopedia'
        // , 'gps'
    ];
}
