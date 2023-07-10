@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-primary">Data User</h5>
                <h6 class="card-subtitle text-muted">Nama, No. HP, E-mail, dan Hak Akses</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>E-mail</th>
                            <th>Hak Akses</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    {!! Form::open([
                                        'route' => ['user.destroy', $item->id],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")'
                                    ]) !!}
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $models->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
