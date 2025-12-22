@extends('temp.temp')

@section('content')
    @if (session('notif'))
        {!! session('notif') !!}
    @endif

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                    Tambah Anggota
                </button>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>No Wa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($anggota as $a)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->username }}</td>
                                    <td>{{ $a->no_wa }}</td>
                                    <td>
                                        <!-- Edit -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editModal{{ $a->id_anggota }}">
                                            Edit
                                        </button>

                                        <!-- Hapus -->
                                        <a href="{{ url('/anggota/hapus/' . $a->id_anggota) }}" class="btn btn-danger"
                                            onclick="return confirm('apakah yakin menghapus data ini ?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $a->id_anggota }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Anggota</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/anggota/edit') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_anggota" value="{{ $a->id_anggota }}">

                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            value="{{ $a->nama }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="username"
                                                            value="{{ $a->username }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No Wa</label>
                                                        <input type="number" class="form-control" name="no_wa"
                                                            value="{{ $a->no_wa }}" required>
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="tambahModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Anggota</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/anggota/tambah') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>

                                    <div class="form-group">
                                        <label>No Wa</label>
                                        <input type="number" class="form-control" name="no_wa" 
                                            required>
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
    </div>
@endsection