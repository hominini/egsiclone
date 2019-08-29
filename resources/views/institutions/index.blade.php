@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Administración de Instituciones
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('institutions.create') }}"> Crear un nueva institución</a>
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
                <th>Nombre</th>
                <th>Siglas</th>
                <th width="280px">Acción</th>
                </tr>
                @foreach ($data as $key => $institution)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $institution->name }}</td>
                    <td>{{ $institution->acronym }}</td>
                    <td>
                    <a class="btn btn-info" href="{{ route('institutions.show',$institution->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('institutions.edit',$institution->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['institutions.destroy', $institution->id],'style'=>'display:inline']) !!}
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
