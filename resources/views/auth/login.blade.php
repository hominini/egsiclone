@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="display-5">EGSI</h3>
                    <p class="text-muted">Sistema de gestión, para el seguimiento y control sobre implementación del Esquema Gubernamental de Seguridad de la Información (EGSI).</p>
                </div>
            </div>
            <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Login</h1>
                    <p class="text-muted">Ingresa a tu cuenta</p>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="icon-user"></i>
                        </span>
                    </div>

                    <input id="cedula" placeholder="{{ __('Cédula / RUC') }}" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="off" autofocus>
                    @error('cedula')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="icon-lock"></i>
                        </span>
                    </div>

                    <input id="password" placeholder="{{ __('Contraseña') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                    <div class="col-6 text-right">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('¿Olvidó su contraseña?') }}
                            </a>
                        @endif
                    </div>
                    </div>
                </form>
                </div>
            </div>
                        <div class="card text-white bg-dark py-5 d-md-down-none" style="width:44%">
                            <div class="card-body text-center">
                                <div class="row pb-lg-5">
                                    <div class="col-sm">
                                        <img src="{{ url('/img/mintel/logo_mintel_blanco.png') }}" width="100%" height="auto">
                                    </div>
                                </div>

                                <div class="row pt-lg-5">
                                    <div class="col-sm">
                                    </div>
                                    <div class="col-sm">
                                        <img src="{{ url('/img/mintel/logo_todaunavida.png') }}" width="100%" height="auto">
                                    </div>
                                    <div class="col-sm">
                                        <img src="{{ url('/img/mintel/logo_gobierno_de_todos.png') }}" width="180%" height="auto">
                                    </div>
                                    <div class="col-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection
