<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;
    protected $table = "sosmeds";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'id_user', 'nama_sosmed', 'link_sosmed'
    ];
}