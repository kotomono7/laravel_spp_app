@extends('layouts.app_sneat')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                <h5 class="card-title text-primary">Hello, Operator! 🎉</h5>
                <p class="mb-4">
                    You are logged in as <mark>{{ Auth::user()->name }}</mark>
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                <img
                    src="{{ asset('sneat') }}/assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                />
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
