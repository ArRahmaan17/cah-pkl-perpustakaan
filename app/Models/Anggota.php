<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    public $timestamps = false;

    protected $fillable = ['nama','username','no_wa'];
}
