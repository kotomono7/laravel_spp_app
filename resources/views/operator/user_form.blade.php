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
                <h5 class="card-title text-primary">Form User</h5>
                <h6 class="card-subtitle text-muted">Tambah Data User Baru</h6>
            </div>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                <div class="form-group">
                    <label for="name">Nama</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="phone">No. HP</label>
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="email">E-mail</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="role">Hak Akses</label>
                    {!! Form::select('role', [
                        'ADMIN' => 'Administrator',
                        'WALI' => 'Wali Murid',
                        'OPERATOR' => 'Operator Sekolah'
                    ], null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-md btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
