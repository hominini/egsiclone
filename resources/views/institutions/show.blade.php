@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Detalles de la Institución

        @endslot

        @slot('card_body')

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6">
                <strong>Imagen institucional:</strong>
                <div class="text-center">
                    <img src="{{ url($institution->institution_picture) }}" class="img-fluid mx-auto d-block" alt="Error al mostrar la imagen.">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {{ $institution->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Siglas:</strong>
                    {{ $institution->acronym }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Descripción:</strong>
                    {{ $institution->description }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sitio web:</strong>
                    {{ $institution->website }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <strong>Ícono:</strong>
                <div class="text-center">
                    <img src="{{ url($institution->icon) }}" class="img-fluid mx-auto d-block" alt="Error al mostrar la imagen.">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Clasificación:</strong>
                    {{ $institution->clasification }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sector:</strong>
                    {{ $institution->sector }}
                </div>
            </div>

        </div>

        @endslot
    @endcomponent
@endsection
