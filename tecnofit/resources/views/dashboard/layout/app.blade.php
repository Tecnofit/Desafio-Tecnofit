@extends('layout.app')
@section('content')

<div class="wrapper">

    <div class="wrapper__sidebar">

    </div>

    <div class="wrapper__body">
        <div class="wrapper__body__content">
            <div class="wrapper__header"></div>
            @yield('content')
            <div class="wrapper__footer">
                <footer>
                    <p>asd</p>
                </footer>
            </div>
        </div>
    </div>
</div>





@endsection
