<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user'; // sesuaikan nama tabel jika beda
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    // Jangan tampilkan password jika dikembalikan ke view
    protected $hidden = [
        'password',
    ];

    public $timestamps = false; // jika tabel tidak ada created_at/updated_at
}
