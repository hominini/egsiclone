@extends('admin.layouts.base')

@section('content')

    @component('admin.components.card')

        @slot('card_header')
            <i class="fa fa-user"></i> Administración de Usuarios
            <div class="card-header-actions">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Crear un nuevo usuario</a>
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
                    <th>Correo electrónico</th>
                    <th>Roles</th>
                    <th width="280px">Acción</th>
                </tr>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                    </td>
                    <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>

            {!! $data->render() !!}

        @endslot

    @endcomponent
@endsection
