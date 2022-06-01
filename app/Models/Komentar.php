<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentars'; 

    public function children(){
        return $this->hasMany(Komentar::class, 'id_komentar_utama');
    }
}
