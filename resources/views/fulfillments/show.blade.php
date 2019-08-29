@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Detalles del cumplimiento
            <div class="card-header-actions">
                <a class="btn btn-success" href="{{ route('fulfillments.index') }}"> Regresar</a>
            </div>
        @endslot

        @slot('card_body')

        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Institución:</strong>
                    {{ $fulfillment->institution->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hito:</strong>
                    <strong>{{ $fulfillment->milestone->milestone_number }}</strong> {{ $fulfillment->milestone->description }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Resumen de actividades realizadas:</strong>
                    {{ $fulfillment->activities_summary }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de cumplimiento:</strong>
                    {{ $fulfillment->fulfillment_date }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre del oficial de seguridad:</strong>
                    {{ $oficial->nombres }} {{ $oficial->apellidos }}
                </div>
            </div>

        </div>
        @endslot
    @endcomponent
@endsection
