@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')
        @slot('card_header')

            Editar Institución
            <div class="card-header-actions">
                <a class="btn btn-danger" href="{{ route('institutions.index') }}"> Cancelar</a>
            </div>

        @endslot

        @slot('card_body')
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Por favor, corrija los errores en el formulario.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            @php
                $clasifications = [
                    'Ejecutiva',
                    'Electoral',
                    'Gobiernos autónomos descentralizados',
                    'Judicial',
                    'Legislativo',
                    'Transparencia institucional',
                ];

                $sectors = [
                    'Función de transparencia y control social',
                    'Electoral',
                    'Judicial',
                    'Función legislativa',
                    'Gobiernos locales',
                    'Sector económico',
                    'Sector hábitat',
                    'Sector de infraestructura y recursos no renovables',
                    'Política exterior',
                    'Producción',
                    'Sector seguridad',
                    'Sector social',
                ];

            @endphp

            {!! Form::model($institution, ['route' => ['institutions.update', $institution->id],'method'=>'PATCH', 'files' => true]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nombre de la Institución:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nombre de la Institución','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Siglas:</strong>
                        {!! Form::text('acronym', null, array('placeholder' => 'Siglas','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Descripción">{{ $institution->description}}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Imagen de la instititución:</strong>
                        {!! Form::file('institution_picture',['class'=>'form-control','value'=>'{{ $institution->institution_picture }}'])!!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sitio Web:</strong>
                        {!! Form::text('website', null, array('placeholder' => 'Sitio Web','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Ícono de la instititución:</strong>
                        {!! Form::file('icon',['class'=>'form-control','placeholder'=>'Ícono de la instititución'])!!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Clasificación:</strong>
                        <select class="form-control" id="clasification" name="clasification">
                            <option value="" disabled selected>Seleccione una clasificación...</option>
                            @foreach ($clasifications as $clasification)
                                <option value="{{$clasification}}" {{ $clasification == $institution->clasification ? "selected" : "" }}>{{$clasification}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sector:</strong>
                        <select class="form-control" id="sector" name="sector">
                            <option value="" disabled>Seleccione un sector...</option>
                            @foreach ($sectors as $sector)
                                <option value="{{$sector}}" {{ $sector == $institution->sector ? "selected" : "" }}>{{$sector}}</option>
                            @endforeach
                        </select>
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
