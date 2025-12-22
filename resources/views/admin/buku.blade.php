@extends('temp.temp')

@section('content')
@if (session('notif'))
    {!! session('notif') !!}
@endif

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ $title }}</h4>

            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Buku
            </button>

            <div class="row">

                @foreach ($buku as $b)
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card tale-bg">
                            <div class="card-people mt-auto">
                                <img src="{{ asset('uploads/' . $b->foto) }}" alt="{{ $b->judul }}">
                            </div>
                            <div class="ml-5 mt-3 mb-2">
                                <h4 class="location font-weight-normal ml-2" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                                    {{ $b->judul }}
                                </h4>
                                <h6 class="font-weight-normal ml-2">by: {{ $b->pengarang }}</h6>
                            </div>

                            <div class="ml-5 mb-3">
                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                    data-target="#detailModal{{ $b->id_buku }}">
                                    Detail
                                </button>

                                <button type="button" class="btn btn-warning mb-2" data-toggle="modal"
                                    data-target="#editModal{{ $b->id_buku }}">
                                    Edit
                                </button>

                                <a href="{{ url('/buku/hapus', $b->id_buku) }}"
                                   class="btn btn-danger"
                                   onclick="return confirm('apakah yakin menghapus data ini ?')">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="detailModal{{ $b->id_buku }}" tabindex="-1"
                        aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <center>
                                        <img class="mb-3" src="{{ asset('uploads/' . $b->foto) }}"
                                             height="300px" width="300px" alt="{{ $b->judul }}">
                                    </center>

                                    <p><strong>Judul: </strong>{{ $b->judul }}</p>
                                    <p><strong>Pengarang: </strong>{{ $b->pengarang }}</p>
                                    <p><strong>Tahun Terbit: </strong>{{ $b->tahun_terbit }}</p>
                                    <p><strong>Keterangan: </strong>{{ $b->keterangan }}</p>
                                    <p><strong>Stok: </strong>{{ $b->stok }}</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $b->id_buku }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form class="forms-sample"
                                          action="{{ url('/buku/update', $b->id_buku) }}"
                                          method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control"
                                                name="judul" value="{{ $b->judul }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <input type="text" class="form-control"
                                                name="pengarang" value="{{ $b->pengarang }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Tahun Terbit</label>
                                            <input type="number" min="1" class="form-control"
                                                name="tahun_terbit" value="{{ $b->tahun_terbit }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control"
                                                name="keterangan" value="{{ $b->keterangan }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="number" min="1" class="form-control"
                                                name="stok" value="{{ $b->stok }}">
                                        </div>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        {{-- Modal Tambah --}}
        <div class="modal fade" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Buku</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="forms-sample"
                              action="{{ url('/buku/tambah') }}"
                              method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul">
                            </div>

                            <div class="form-group">
                                <label>Pengarang</label>
                                <input type="text" class="form-control" name="pengarang">
                            </div>

                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input type="number" min="1" class="form-control" name="tahun_terbit">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan">
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" min="1" class="form-control" name="stok">
                            </div>

                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection