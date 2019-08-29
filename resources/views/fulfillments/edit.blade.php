@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')
        @slot('card_header')

            Editar Cumplimiento
            <div class="card-header-actions">
                <a class="btn btn-danger" href="{{ route('fulfillments.index') }}"> Cancelar</a>
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

            {!! Form::model($fulfillment, ['route' => ['fulfillments.update', $fulfillment->id ],'method'=>'PATCH']) !!}
            <div class="row">

                {{-- Institucion --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Institución:</strong>
                        {!! Form::select('institution_id', $institutions, (string)$fulfillment->institution->id, array('class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Hito --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hito:</strong>
                        {!! Form::select('milestone_id', $milestones, (string)$fulfillment->milestone->id, array('class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Fecha de cumplimiento --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Fecha de cumplimiento:</strong>
                        <input type="date" name="fulfillment_date" class="form-control" value="{{ $fulfillment->fulfillment_date }}">
                    </div>
                </div>

                {{-- Oficial de seguridad --}}
                {{ Form::hidden('oficial_de_seguridad_id', Auth::user()->id ) }}

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
            {!! Form::close() !!}
        @endslot
    @endcomponent
@endsection
