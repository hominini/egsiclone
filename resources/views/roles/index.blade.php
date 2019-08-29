@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Administración de Permisos
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('roles.create') }}"> Crear un nuevo rol</a>
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
                    <th width="280px">Acción</th>
                </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Ver</a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $roles->render() !!}
        @endslot
    @endcomponent
@endsection
