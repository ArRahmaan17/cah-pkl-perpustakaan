<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    // public function __construct()
    // {
    //     // sama seperti CI3: if(!$this->session->userdata)
    //     $this->middleware('auth');
    // }

    public function index()
    {

        $data = [
            'title' => 'Buku',
            'buku' => Buku::all()
        ];

        return view('admin.buku', $data);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'keterangan' => 'required',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        // upload foto
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $namaFoto);
        }

        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
            'foto' => $namaFoto
        ]);
        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function update(Request $request, $id_buku)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'keterangan' => 'required',
            'stok' => 'required|integer',
        ]);

        $buku = Buku::findOrFail($id_buku);

        $buku->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
        ]);
        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function hapus($id_buku)
    {
        $buku = Buku::findOrFail($id_buku);

        // hapus gambar fisik
        if ($buku->foto && file_exists(public_path('uploads/' . $buku->foto))) {
            unlink(public_path('uploads/' . $buku->foto));
        }

        $buku->delete();
        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $hasil = Buku::where('judul', 'like', "%$keyword%")->get();

        return view('admin.buku', [
            'title' => "Cari Buku",
            'buku' => $hasil
        ]);
    }
}
