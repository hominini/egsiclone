@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Administración de Cumplimientos
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('fulfillments.create') }}"> Nuevo cumplimiento</a>
            </div>

        @endslot

        @slot('card_body')

            {{-- Alert --}}
            @if ($message = Session::get('success'))
                @component('components.success-alert')
                    {{ $message }}
                @endcomponent
            @endif

            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <tr>
                <th>No</th>
                <th>Institución</th>
                <th>Hito</th>
                <th>Resumen de actividades realizadas</th>
                <th>Fecha de cumplimiento</th>
                <th width="280px">Acción</th>
                </tr>
                @foreach ($data as $key => $fulfillment)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $fulfillment->institution->name }}</td>
                    <td>{{ $fulfillment->milestone->description }}</td>
                    <td>{{ $fulfillment->activities_summary }}</td>
                    <td>{{ $fulfillment->fulfillment_date }}</td>
                    <td>
                    <a class="btn btn-info" href="{{ route('fulfillments.show',$fulfillment->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('fulfillments.edit',$fulfillment->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['fulfillments.destroy', $fulfillment->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>

            {!! $data->render() !!}
        @endslot
    @endcomponent
@endsection
