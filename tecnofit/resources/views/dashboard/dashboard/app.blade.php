@extends('dashboard.layout.app')
@section('content-dashboard')
    <section>
        <h1>Dashboard</h1>
        <div class="row">
            @foreach ($data as $key => $value)
                <div class="col">
                    <div class="card my-3" style="border-top: 5px solid #0052cc;">
                        <div class="d-flex flex-column my-4 align-items-center">
                            <h5 class="text-muted">{{ $key }}</h5>
                            <h1 class="">{{ $value }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
