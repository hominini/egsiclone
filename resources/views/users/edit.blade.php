@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Editar Usuario
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Regresar</a>
            </div>

        @endslot

        @slot('card_body')

            @if (count($errors) > 0)
                @component('components.alert')
                    @slot('title')
                        <strong>Lo sentimos!</strong> Debe corregir los siguientes errores antes de ingresar el formulario:
                    @endslot

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endcomponent
            @endif

            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nombres:</strong>
                        {!! Form::text('nombres', null, array('placeholder' => 'Nombre','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Apellidos:</strong>
                        {!! Form::text('apellidos', null, array('placeholder' => 'Apellidos','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cédula o Pasaporte:</strong>
                        {!! Form::text('cedula', null, array('placeholder' => 'Cédula o Pasaporte','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cargo:</strong>
                        {!! Form::text('cargo', null, array('placeholder' => 'Cargo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Área:</strong>
                        {!! Form::text('area', null, array('placeholder' => 'Área','class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Institucion --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Institución:</strong>
                        {!! Form::select('institucion_id', $institutions, (string)$user->institucion_id, array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Correo institucional:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Correo institucional','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Contraseña:</strong>
                        {!! Form::password('password', array('placeholder' => 'Contraseña','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirmar Contraseña:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirmar Contraseña','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Rol/es:</strong>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
            {!! Form::close() !!}

        @endslot
    @endcomponent
@endsection



