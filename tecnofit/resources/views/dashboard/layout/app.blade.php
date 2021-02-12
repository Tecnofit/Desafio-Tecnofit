@extends('layout.app')
@section('content')

<div class="wrapper">

    @include('dashboard.layout.sidebar')

    <div class="wrapper__body">
        <div class="wrapper__body__content">
            @yield('content-dashboard')
        </div>
    </div>
</div>





@endsection
