@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Detalles del Hito
            <div class="card-header-actions">
                <a class="btn btn-danger" href="{{ route('milestones.index') }}"> Regresar</a>
            </div>
        @endslot

        @slot('card_body')

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoría:</strong>
                    {{ $milestone->category->getParent()->number }} {{ $milestone->category->getParent()->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subcategoría:</strong>
                    {{ $milestone->category->number }} {{ $milestone->category->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Número de hito:</strong>
                    {{ $milestone->milestone_number }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Denominación:</strong>
                    {{ $milestone->description }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>¿Es priotitario?:</strong>
                    {{ $milestone->is_a_priority == 0 ? 'No' : 'Sí' }}
                </div>
            </div>

        </div>

        @endslot
    @endcomponent
@endsection
