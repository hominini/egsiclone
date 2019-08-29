@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')
        @slot('card_header')

            Crear registro de cumplimiento
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

            {!! Form::open(array('route' => 'fulfillments.store','method'=>'POST')) !!}
            <div class="row">

                {{-- Institucion --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Institución:</strong>
                        {!! Form::select('institution_id', $institutions, null, array('class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Hito --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Hito:</strong>
                        {!! Form::select('milestone_id', $milestones, null, array('class' => 'form-control')) !!}
                    </div>
                </div>

                {{-- Fecha de cumplimiento --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Fecha de cumplimiento:</strong>
                        <input type="date" name="fulfillment_date" class="form-control" value="2018-07-22">
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
