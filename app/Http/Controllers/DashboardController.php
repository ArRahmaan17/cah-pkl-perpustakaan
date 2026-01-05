<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{

public function index()
{
    $data = [
        'title' => 'Dashboard Perpustakaan',
        'user' => User::count(),
        'buku' => Buku::count(),
        'peminjaman' => Peminjaman::count(),
    ];

    return view('admin.dashboard', $data);
}


}
