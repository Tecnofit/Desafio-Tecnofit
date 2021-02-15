@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-info">
        {{session('message')}}
    </div>
@endif
