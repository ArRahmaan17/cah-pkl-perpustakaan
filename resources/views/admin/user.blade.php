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
                    Tambah User
                </button>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($user as $u)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $u->nama }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->role }}</td>
                                    <td>
                                        <!-- Edit -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editModal{{ $u->id_user }}">
                                            Edit
                                        </button>

                                        <!-- Hapus -->
                                        <a href="{{ url('/user/hapus/' . $u->id_user) }}" class="btn btn-danger"
                                            onclick="return confirm('apakah yakin menghapus data ini ?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $u->id_user }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/user/edit') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_user" value="{{ $u->id_user }}">

                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            value="{{ $u->nama }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="username"
                                                            value="{{ $u->username }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select class="form-control" name="role">
                                                            <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>
                                                                Admin</option>
                                                            <option value="petugas" {{ $u->role == 'petugas' ? 'selected' : '' }}>
                                                                Petugas</option>
                                                        </select>
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
                                <h5 class="modal-title">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/user/tambah') }}" method="post">
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
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" required>
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