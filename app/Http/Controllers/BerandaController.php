<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Perpustakaan',
            'buku' => DB::table('buku')->get(),
        ];

        return view('beranda', $data);
    }

    public function detail($id_buku)
    {
        $data = [
            'title' => 'Dashboard Perpustakaan',
            'buku' => DB::table('buku')->where('id_buku', $id_buku)->first(),
        ];

        return view('detail', $data);
    }
}
