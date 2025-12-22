@extends('temp.temp')

@section('content')
    @if (session('notif'))
        {!! session('notif') !!}
    @endif

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($denda as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->denda }}</td>
                                    <td>
                                        <!-- Edit -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editDendaModal{{ $d->id_denda }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editDendaModal{{ $d->id_denda }}" tabindex="-1"
                                    aria-labelledby="editDendaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Denda</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/denda/update', $d->id_denda) }}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label>Denda</label>
                                                        <input type="number" class="form-control" name="denda"
                                                            value="{{ $d->denda }}" required>
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
