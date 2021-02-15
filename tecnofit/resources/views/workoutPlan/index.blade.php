@extends('workoutPlan.layout')
@section('content-workout')


    <section>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">TECNOFIT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col my-3">
                    <div class="card">
                        <div class="card-body">
                            @include('includes.alerts')

                            <!--Table-->
                            @if (isset($training->trainings) && $training->trainings->isNotEmpty() && $training->trainings[0]->active)
                                <h1 class="card-title">Treino</h1>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Exercicio</th>
                                            <th>Sessões</th>
                                            <th>Status</th>
                                            <th width="200">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($training->trainings as $item)
                                            <tr>
                                                <td>{{ $item->exercises->name }}</td>
                                                <td>{{ $item->sessions }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <form action="{{ route('workout.skip') }}" method="POST"
                                                        class="mx-1 d-inline-block">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="id" />
                                                        <button type="submit" style="border:none; background: transparent;">
                                                            <i class="fa fa-forward text-dark"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('workout.completed') }}" method="POST"
                                                        class="mx-1 d-inline-block">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="id" />
                                                        <button type="submit"
                                                            style="border:none; background: transparent;"><i
                                                                class="fa fa-check text-success"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-primary" role="alert">
                                    Você não possui nenhum treino ativo.
                                </div>
                            @endif
                            <!--End Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
