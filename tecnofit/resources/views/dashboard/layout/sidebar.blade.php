<div class="wrapper__sidebar">
    <div class="logo">
        <a href="{{route('dashboard')}}">
            <img src="{{ url('assets/images/logo.png') }}" alt="tecnofit">
        </a>
    </div>
    <ul class="menu">
        <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
        <li class="{{ (request()->is('customers')) ? 'active' : '' }}"><a href="{{route('customers.index')}}"><i class="fa fa-users" aria-hidden="true"></i>Clientes</a></li>
        <li class="{{ (request()->is('exercises')) ? 'active' : '' }}"><a href="{{route('exercises.index')}}"><i class="fa fa-dumbbell" aria-hidden="true"></i>Exercicios</a></li>
        <li class="{{ (request()->is('trainings')) ? 'active' : '' }}"><a href="{{route('trainings.index')}}"><i class="fa fa-list" aria-hidden="true"></i>Treinos</a></li>
        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>Sair</a></li>
    </ul>
</div>
