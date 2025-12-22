@extends('temp.temp')

@section('content')
    @if (session('notif'))
        {!! session('notif') !!}
    @endif
    <style>
        @media print {
            .col-lg-12 * {
                visibility: hidden;
            }

            .modal * {
                visibility: visible;
            }

            .main-menu,
            .sidebar,
            #sidebar {
                display: none !important;
            }

            .modal-footer * {
                visibility: hidden;
            }
        }
    </style>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Peminjaman
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#laporanModal">
                    Laporan
                </button>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Nama</th>
                                <th>No Wa</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Tanggal Dikembalikan</th>
                                <th>Status</th>
                                <th>Petugas</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($peminjaman as $p)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $p->buku->judul }}</td>
                                    <td>{{ $p->anggota->nama }}</td>
                                    <td>{{ $p->anggota->no_wa }}</td>
                                    <td>{{ $p->tanggal_pinjam }}</td>
                                    <td>{{ $p->tanggal_kembali }}</td>
                                    <td>{{ $p->tanggal_dikembalikan }}</td>

                                    <td>
                                        @if ($p->status == 'dipinjam')
                                            <p><label class="btn btn-warning btn-rounded btn-fw">{{ $p->status }}</label></p>
                                        @elseif ($p->status == 'dikembalikan')
                                            <p><label class="badge badge-success btn-rounded btn-fw">{{ $p->status }}</label></p>
                                        @else
                                            <p><label class="badge badge-danger btn-rounded btn-fw">{{ $p->status }}</label></p>
                                        @endif
                                    </td>

                                    <td>{{ $p->petugasUser->username }}</td>
                                    <td>Rp {{ number_format($p->denda, 0, ',', '.') }}</td>

                                    <td>
                                        @if ($p->status == 'dipinjam' || $p->status == 'terlambat')
                                            <a href="{{ url('peminjaman/kembalikan/' . $p->id_peminjaman) }}"
                                                class="btn btn-primary"
                                                onclick="return confirm('Buku Sudah Dikembalikan dan Denda Sudah Dibayar?');">
                                                Kembalikan
                                            </a>
                                        @endif

                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#detailModal{{ $p->id_peminjaman }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailModal{{ $p->id_peminjaman }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Struk</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <!-- STRUK (print-area) -->
                                                <div class="print-area"
                                                    style="width: 280px; margin: auto; padding: 15px; border: 1px dashed #000; font-size: 13px; font-family: monospace;">

                                                    <h5 style="text-align: center; margin-bottom: 10px;">STRUK PEMINJAMAN</h5>
                                                    <hr style="border-top: 1px dashed #000;">

                                                    <p><strong>Nama</strong> : {{ $p->anggota->nama }}</p>
                                                    <p><strong>No WA</strong> : {{ $p->anggota->no_wa }}</p>
                                                    <p><strong>Judul Buku</strong> : {{ $p->buku->judul }}</p>

                                                    <hr style="border-top: 1px dashed #000;">

                                                    <p><strong>Tgl Pinjam</strong> : {{ $p->tanggal_pinjam }}</p>
                                                    <p><strong>Tgl Kembali</strong> : {{ $p->tanggal_kembali }}</p>
                                                    <p><strong>Dikembalikan</strong> : {{ $p->tanggal_dikembalikan ?? '-' }}</p>

                                                    <hr style="border-top: 1px dashed #000;">

                                                    <p><strong>Status</strong> : {{ ucfirst($p->status) }}</p>
                                                    <p><strong>Denda</strong> : Rp {{ number_format($p->denda, 0, ',', '.') }}
                                                    </p>
                                                    <p><strong>Petugas</strong> : {{ $p->petugasUser->username }}</p>

                                                    <hr style="border-top: 1px dashed #000;">

                                                    <p style="text-align: center; font-size: 12px;">Terima kasih telah
                                                        berkunjung<br>Perpustakaan</p>

                                                </div>
                                                <!-- END STRUK -->

                                            </div>

                                            <div class="modal-footer">
                                                <button onclick="window.print()" class="btn btn-info btn-icon-text">
                                                    Print <i class="ti-printer btn-icon-append"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- MODAL TAMBAH -->
                <div class="modal fade" id="exampleModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Peminjaman</h5>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ url('peminjaman/tambah') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <select class="form-control select2" name="anggota_id">
                                            @foreach ($anggota as $a)
                                                <option value="{{ $a->id_anggota }}">{{ $a->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Buku</label>
                                        <select class="form-control select2" name="buku_id">
                                            @foreach ($buku as $b)
                                                @if ($b->stok > 0)
                                                    <option value="{{ $b->id_buku }}">{{ $b->judul }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Pinjam</label>
                                        <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}"
                                            name="tanggal_pinjam" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <input type="date" class="form-control" name="tanggal_kembali" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Petugas</label>
                                        <input type="text" class="form-control" value="{{ session('username') }}" readonly>

                                    </div>

                                    <input type="hidden" name="petugas" value="{{ session('user_id') }}">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- MODAL LAPORAN -->
                <div class="modal fade" id="laporanModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Laporan Peminjaman</h5>
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ route('cek') }}" method="get">

                                    <div class="form-group">
                                        <label>Dari</label>
                                        <input type="date" class="form-control" name="tanggal1">
                                    </div>

                                    <div class="form-group">
                                        <label>Sampai</label>
                                        <input type="date" class="form-control" name="tanggal2">
                                    </div>

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection