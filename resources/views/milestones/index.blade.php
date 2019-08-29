@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Administración de Hitos
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('milestones.create') }}"> Nuevo hito</a>
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
                <th>Número</th>
                <th>Denominación</th>
                <th>¿Prioritario?</th>
                <th width="280px">Acción</th>
                </tr>
                @foreach ($data as $key => $milestone)
                <tr>
                    <td>{{ $milestone->milestone_number }}</td>
                    <td>{{ $milestone->description }}</td>
                    <td>{{ $milestone->is_a_priority == 0 ? 'No' : 'Sí' }}</td>
                    <td>
                    <a class="btn btn-info" href="{{ route('milestones.show',$milestone->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('milestones.edit',$milestone->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['milestones.destroy', $milestone->id],'style'=>'display:inline']) !!}
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
