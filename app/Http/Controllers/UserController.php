<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Cek login (seperti CI3)
        // if (!session('login')) {
        //     return redirect('/login');
        // }

        $data = [
            'title' => 'User',
            'user'  => User::all()
        ];

        return view('admin.user', $data);
    }

    public function tambah(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

            Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

            return redirect()->back();
    }

    public function edit(Request $request)
    {
        User::where('id_user', $request->id_user)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }

    public function hapus($id_user)
    {
        User::where('id_user', $id_user)->delete();

        Session::flash('notif', '<div class="alert alert-primary">Berhasil</div>');

        return redirect()->back();
    }
}
