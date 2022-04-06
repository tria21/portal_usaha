<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role', 'nama_usaha', 'jenis_usaha', 'alamat_usaha'
    ];
}
