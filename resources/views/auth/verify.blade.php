@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su Dirección de Correo Electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un enlace de verificación nuevo ha sido enviado a su cuenta de correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor revise su correo electrónico por el enlace de confirmación.') }}
                    {{ __('Si no recibió el correo.') }}, <a href="{{ route('verification.resend') }}">{{ __('dar clic aquí para pedir otro.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
