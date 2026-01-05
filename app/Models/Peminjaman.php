<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'buku_id',
        'anggota_id',
        'petugas',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda_id',
    ];

    public function dendaRel()
{
    return $this->belongsTo(Denda::class, 'denda_id', 'id_denda');
}

    public function buku()
{
    return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
}

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id_anggota');
    }

    public function petugasUser()
    {
        return $this->belongsTo(User::class, 'petugas', 'id_user');
    }
}
