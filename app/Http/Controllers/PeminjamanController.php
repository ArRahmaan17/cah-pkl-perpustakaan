<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PeminjamanController extends Controller
{
    public function index()
{
    $peminjaman = Peminjaman::with(['buku', 'anggota', 'petugasUser'])->get();
    $today = strtotime(date('Y-m-d'));

    $dendaRecord = Denda::first();
    $dendaPerHari = $dendaRecord ? $dendaRecord->denda : 10000;

    foreach ($peminjaman as $p) {
        $tanggalPinjam = strtotime($p->tanggal_pinjam);
        $tanggalKembali = strtotime($p->tanggal_kembali);

        if ($p->status === 'dipinjam' || $p->status === 'terlambat') {
            if ($today > $tanggalKembali) {
                $hariTerlambat = ceil(($today - $tanggalKembali) / 86400);
                $p->denda = $hariTerlambat * $dendaPerHari;
                $p->status = 'terlambat';
                $p->update([
                    'status' => 'terlambat',
                    'denda' => $p->denda
                ]);
            } else {
                $hariDipinjam = ceil(($today - $tanggalPinjam) / 86400);
                $p->denda = $hariDipinjam * $dendaPerHari;
            }
        }
    }

    return view('admin.peminjaman', [
        'title' => 'Peminjaman',
        'peminjaman' => $peminjaman,
        'anggota' => Anggota::all(),
        'buku' => Buku::where('stok', '>', 0)->get(),
        'user' => User::all()
    ]);
}

public function tambah(Request $request)
{
    $request->validate([
        'anggota_id' => 'required',
        'buku_id' => 'required',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    $denda = Denda::first(); 

    Peminjaman::create([
        'anggota_id' => $request->anggota_id,
        'buku_id' => $request->buku_id,
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'dipinjam',
        // 'petugas' => $request->petugas,
        'petugas' => session('user_id'),
        'denda' => $denda->denda, 
    ]);

    Buku::where('id_buku', $request->buku_id)->decrement('stok');

    return redirect('peminjaman')->with('notif', '<div class="alert alert-success">Peminjaman berhasil ditambahkan!</div>');
}

    public function kembalikan($id_peminjaman)
    {
        $p = Peminjaman::findOrFail($id_peminjaman);
        $today = date('Y-m-d');

        $p->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
        ]);

        Buku::where('id_buku', $p->buku_id)->increment('stok');

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');
        return redirect()->back();
    }
    public function cek(Request $request)
    {
        $tanggal1 = $request->query('tanggal1');
        $tanggal2 = $request->query('tanggal2');

        $query = Peminjaman::with(['buku', 'anggota', 'petugasUser']);

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $query->whereBetween('tanggal_pinjam', [$tanggal1, $tanggal2]);
        }

        $peminjaman = $query->get();

        return view('admin.laporan', [
            'title' => 'Laporan Peminjaman',
            'peminjaman' => $peminjaman,
            'tanggal1' => $tanggal1,
            'tanggal2' => $tanggal2,
        ]);
    }

    // Method untuk cetak laporan
    public function cetak()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota', 'petugasUser'])->get();

        $today = Carbon::today();

        foreach ($peminjaman as $p) {
            if ($p->status === 'dipinjam' && $today->gt(Carbon::parse($p->tanggal_kembali))) {
                $selisih = $today->diffInDays(Carbon::parse($p->tanggal_kembali));
                $denda = $selisih * 10000;

                // Update di database
                $p->update([
                    'status' => 'terlambat',
                    'denda' => $denda
                ]);

                // Update object untuk tampil
                $p->status = 'terlambat';
                $p->denda = $denda;
            }
        }

        return view('admin.laporan', [
            'title' => 'Peminjaman',
            'peminjaman' => $peminjaman,
            'anggota' => Anggota::all(),
            'buku' => Buku::where('stok', '>', 0)->get()
        ]);
    }
}
