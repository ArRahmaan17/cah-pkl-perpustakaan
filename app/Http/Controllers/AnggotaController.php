<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        // Cek login (seperti CI3)
        // if (!session('login')) {
        //     return redirect('/login');
        // }

        $data = [
            'title' => 'Anggota',
            'anggota'  => Anggota::all()
        ];

        return view('admin.anggota', $data);
    }

    public function tambah(Request $request)
    {
        Anggota::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_wa' => $request->no_wa,
        ]);

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function edit(Request $request)
    {
        Anggota::where('id_anggota', $request->id_anggota)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'no_wa' => $request->no_wa,
        ]);

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function hapus($id_anggota)
    {
        Anggota::where('id_anggota', $id_anggota)->delete();

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }
}
