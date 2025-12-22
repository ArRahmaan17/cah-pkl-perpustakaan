<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DendaController extends Controller
{
    public function index()
    {
         $data = [
            'title' => 'Denda',
            'denda'  => Denda::all()
        ];

        return view('admin.denda', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'denda' => 'required|numeric'
        ]);

        $denda = Denda::first();

        if ($denda) {
            // Update
            $denda->update([
                'denda' => $request->denda
            ]);
            Session::flash('notif', '<div class="alert alert-success">Denda berhasil diupdate!</div>');
        } else {
            // Buat baru
            Denda::create([
                'denda' => $request->denda
            ]);
            Session::flash('notif', '<div class="alert alert-primary">Denda berhasil disimpan!</div>');
        }

        return redirect()->back();
    }
}
